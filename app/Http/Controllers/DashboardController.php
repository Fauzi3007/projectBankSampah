<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Provinsi;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\PerhitunganSampah;
use App\Models\Sarana;
use Illuminate\Support\Facades\DB as FacadesDB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch necessary data for filters
        $saranas = Sarana::join('users','saranas.nama_admin','=','users.id')->where('users.role','=','admin')->get();
        $provinsis = Provinsi::get();
        $kategoris = Kategori::with('subkategoris')->get();
        $subkategoris = SubKategori::all();

        // Data for stacked bar chart: total amount of waste per category created by each user
        $stackedBarData = PerhitunganSampah::join('saranas','perhitungan_sampahs.sarana_id_sarana','=','saranas.id_sarana')
            ->select('sarana_id_sarana', 'nama_sarana', FacadesDB::raw('SUM(jumlah_sampah) as total_sampah'))
            ->groupBy('sarana_id_sarana', 'nama_sarana')
            ->with('sarana')
            ->get()
            ->groupBy('sarana_id_sarana');

        // Data for pie chart: percentage of waste per category
        $pieChartData = PerhitunganSampah::select('kategori_id_kategori', FacadesDB::raw('SUM(jumlah_sampah) as total_sampah'))
            ->groupBy('kategori_id_kategori')
            ->with('kategori')
            ->get();

        $totalSampah = $pieChartData->sum('total_sampah');
        foreach ($pieChartData as $data) {
            $data->percentage = ($data->total_sampah / $totalSampah) * 100;
        }

        // Data for bar chart: total amount of waste per category in each province
        $barChartData = PerhitunganSampah::join('saranas', 'perhitungan_sampahs.sarana_id_sarana', '=', 'saranas.id_sarana')
            ->join('provinsis', 'saranas.provinsi_id_provinsi', '=', 'provinsis.id_provinsi')
            ->select('saranas.provinsi_id_provinsi', 'provinsis.nama_provinsi', FacadesDB::raw('SUM(jumlah_sampah) as total_sampah'))
            ->groupBy('saranas.provinsi_id_provinsi', 'provinsis.nama_provinsi')
            ->where('jumlah_sampah', '!=', null)
            ->get()
            ->groupBy('provinsi_id_provinsi');



        return view('pages.dashboard.dashboard', compact('saranas', 'provinsis', 'subkategoris','kategoris', 'stackedBarData', 'pieChartData', 'barChartData'));
    }

    public function filterData(Request $request)
{
    $saranas = Sarana::join('users', 'saranas.nama_admin', '=', 'users.id')
        ->where('users.role', '=', 'admin')
        ->get();

    $provinsis = Provinsi::get();
    $kategoris = Kategori::with('subkategoris')->get();
    $subkategoris = SubKategori::all();

    $filterTanggal = $request->input('selectedTanggal') ?? '';
    $filterSarana = $request->input('selectedUser') ?? [];
    $filterProvinsi = $request->input('selectedProvinsi') ?? [];
    $filterKategori = $request->input('selectedJenis') ?? [];
    $filterSubkategori = $request->input('selectedSubjenis') ?? [];

    // Data for stacked bar chart: total amount of waste per category created by each user
    $stackedBarData = PerhitunganSampah::join('saranas', 'perhitungan_sampahs.sarana_id_sarana', '=', 'saranas.id_sarana')->join('provinsis', 'saranas.provinsi_id_provinsi', '=', 'provinsis.id_provinsi')
        ->select('saranas.id_sarana', 'saranas.nama_sarana', FacadesDB::raw('SUM(perhitungan_sampahs.jumlah_sampah) as total_sampah'))
        ->groupBy('saranas.id_sarana', 'saranas.nama_sarana')
        ->with('sarana')
        ->when($filterTanggal, function ($query) use ($filterTanggal) {
            $dates = explode(' - ', $filterTanggal);
            if (count($dates) > 1) {
                $carbonDate1 = \Carbon\Carbon::createFromFormat('M d, Y', $dates[0]);
                $carbonDate2 = \Carbon\Carbon::createFromFormat('M d, Y', $dates[1]);
                return $query->whereBetween('perhitungan_sampahs.tanggal', [$carbonDate1, $carbonDate2]);
            } else {
                $carbonDate = \Carbon\Carbon::createFromFormat('M d, Y', $dates[0]);
                return $query->where('perhitungan_sampahs.tanggal', $carbonDate);
            }
        })
        ->when($filterSarana, function ($query) use ($filterSarana) {
            return $query->whereIn('saranas.nama_admin', $filterSarana);
        })
        ->when($filterProvinsi, function ($query) use ($filterProvinsi) {
            return $query->whereIn('provinsis.id_provinsi', $filterProvinsi);
        })
        ->when($filterKategori, function ($query) use ($filterKategori) {
            return $query->whereIn('perhitungan_sampahs.kategori_id_kategori', $filterKategori);
        })
        ->when($filterSubkategori, function ($query) use ($filterSubkategori) {
            return $query->whereIn('perhitungan_sampahs.subkategori_id_subkategori', $filterSubkategori);
        })
        ->get()
        ->groupBy('user_id_user');

    // Data for pie chart: percentage of waste per category
    $pieChartData = PerhitunganSampah::join('saranas', 'perhitungan_sampahs.sarana_id_sarana', '=', 'saranas.id_sarana')->join('provinsis', 'saranas.provinsi_id_provinsi', '=', 'provinsis.id_provinsi')->select('perhitungan_sampahs.kategori_id_kategori', FacadesDB::raw('SUM(perhitungan_sampahs.jumlah_sampah) as total_sampah'))
        ->groupBy('perhitungan_sampahs.kategori_id_kategori')
        ->with('kategori')
        ->when($filterTanggal, function ($query) use ($filterTanggal) {
            $dates = explode(' - ', $filterTanggal);
            if (count($dates) > 1) {
                $carbonDate1 = \Carbon\Carbon::createFromFormat('M d, Y', $dates[0]);
                $carbonDate2 = \Carbon\Carbon::createFromFormat('M d, Y', $dates[1]);
                return $query->whereBetween('perhitungan_sampahs.tanggal', [$carbonDate1, $carbonDate2]);
            } else {
                $carbonDate1 = \Carbon\Carbon::createFromFormat('M d, Y', $dates[0]);
                return $query->where('perhitungan_sampahs.tanggal', $carbonDate1);
            }
        })
        ->when($filterSarana, function ($query) use ($filterSarana) {
            return $query->whereIn('saranas.nama_admin', $filterSarana);
        })
        ->when($filterProvinsi, function ($query) use ($filterProvinsi) {
            return $query->whereIn('provinsis.id_provinsi', $filterProvinsi);
        })
        ->when($filterKategori, function ($query) use ($filterKategori) {
            return $query->whereIn('perhitungan_sampahs.kategori_id_kategori', $filterKategori);
        })
        ->when($filterSubkategori, function ($query) use ($filterSubkategori) {
            return $query->whereIn('perhitungan_sampahs.subkategori_id_subkategori', $filterSubkategori);
        })
        ->get();

    $totalSampah = $pieChartData->sum('total_sampah');
    $pieChartData->each(function ($data) use ($totalSampah) {
        $data->percentage = ($data->total_sampah / $totalSampah) * 100;
    });

    // Data for bar chart: total amount of waste per category in each province
    $barChartData = PerhitunganSampah::join('saranas', 'perhitungan_sampahs.sarana_id_sarana', '=', 'saranas.id_sarana')
        ->join('provinsis', 'saranas.provinsi_id_provinsi', '=', 'provinsis.id_provinsi')
        ->select('provinsis.id_provinsi', 'provinsis.nama_provinsi', FacadesDB::raw('SUM(perhitungan_sampahs.jumlah_sampah) as total_sampah'))
        ->groupBy('provinsis.id_provinsi', 'provinsis.nama_provinsi')
        ->where('perhitungan_sampahs.jumlah_sampah', '!=', null)
        ->when($filterTanggal, function ($query) use ($filterTanggal) {
            $dates = explode(' - ', $filterTanggal);
            if (count($dates) > 1) {
                $carbonDate1 = \Carbon\Carbon::createFromFormat('M d, Y', $dates[0]);
                $carbonDate2 = \Carbon\Carbon::createFromFormat('M d, Y', $dates[1]);
                return $query->whereBetween('perhitungan_sampahs.tanggal', [$carbonDate1, $carbonDate2]);
            } else {
                $carbonDate1 = \Carbon\Carbon::createFromFormat('M d, Y', $dates[0]);
                return $query->where('perhitungan_sampahs.tanggal', $carbonDate1);
            }
        })
        ->when($filterSarana, function ($query) use ($filterSarana) {
            return $query->whereIn('saranas.nama_admin', $filterSarana);
        })
        ->when($filterProvinsi, function ($query) use ($filterProvinsi) {
            return $query->whereIn('provinsis.id_provinsi', $filterProvinsi);
        })
        ->when($filterKategori, function ($query) use ($filterKategori) {
            return $query->whereIn('perhitungan_sampahs.kategori_id_kategori', $filterKategori);
        })
        ->when($filterSubkategori, function ($query) use ($filterSubkategori) {
            return $query->whereIn('perhitungan_sampahs.subkategori_id_subkategori', $filterSubkategori);
        })
        ->get()
        ->groupBy('provinsi_id_provinsi');

    return view('pages.dashboard.dashboard', compact('saranas', 'provinsis', 'kategoris', 'subkategoris', 'stackedBarData', 'pieChartData', 'barChartData'));
}

}
