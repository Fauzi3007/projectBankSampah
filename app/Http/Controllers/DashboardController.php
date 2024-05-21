<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\PerhitunganSampah;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch necessary data for filters
        $users = User::all();
        $provinsis = Provinsi::with('kotas')->get();
        $kategoris = Kategori::with('subkategoris')->get();

        // Data for stacked bar chart: total amount of waste per category created by each user
        $stackedBarData = PerhitunganSampah::select('user_id_user', 'kategori_id_kategori', FacadesDB::raw('SUM(jumlah_sampah) as total_sampah'))
            ->groupBy('user_id_user', 'kategori_id_kategori')
            ->with('user', 'kategori')
            ->get()
            ->groupBy('user_id_user');

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
        $barChartData = PerhitunganSampah::join('saranas','perhitungan_sampahs.sarana_id_sarana','=','saranas.id_sarana')->select('saranas.provinsi_id_provinsi', 'kategori_id_kategori', FacadesDB::raw('SUM(jumlah_sampah) as total_sampah'))
            ->groupBy('saranas.provinsi_id_provinsi', 'kategori_id_kategori')
            ->where('jumlah_sampah', '!=', null)
            ->with('provinsi', 'kategori')
            ->get()
            ->groupBy('provinsi_id_provinsi');


        return view('pages.dashboard.dashboard', compact('users', 'provinsis', 'kategoris', 'stackedBarData', 'pieChartData', 'barChartData'));
    }

    public function filterData(Request $request)
    {
        $users = User::all();
        $provinsis = Provinsi::with('kotas')->get();
        $kategoris = Kategori::with('subkategoris')->get();

        $filterTanggal = $request->filled('selectedTanggal') ? $request->input('selectedTanggal') : null;
        $filterUser = $request->filled('selectedUser') ? $request->input('selectedUser') : null;
        $filterProvinsi = $request->filled('selectedJenis') ? $request->input('selectedJenis') : null;
        $filterKategori = $request->filled('selectedProvinsi') ? $request->input('selectedProvinsi') : null;


        // Data for stacked bar chart: total amount of waste per category created by each user
        $stackedBarData = PerhitunganSampah::select('user_id_user', 'kategori_id_kategori', FacadesDB::raw('SUM(jumlah_sampah) as total_sampah'))
            ->groupBy('user_id_user', 'kategori_id_kategori')
            ->with('user', 'kategori')
            ->when($filterTanggal, function ($query) use ($filterTanggal) {
                $dates = explode(' to ', $filterTanggal);
                return $query->whereBetween('tanggal', [$dates[0], $dates[1]]);
            })
            ->when($filterUser, function ($query) use ($filterUser) {
                return $query->where('user_id_user', $filterUser);
            })
            ->get()
            ->groupBy('user_id_user');

        // Data for pie chart: percentage of waste per category
        $pieChartData = PerhitunganSampah::select('kategori_id_kategori', FacadesDB::raw('SUM(jumlah_sampah) as total_sampah'))
            ->groupBy('kategori_id_kategori')
            ->with('kategori')
            ->when($filterTanggal, function ($query) use ($filterTanggal) {
                $dates = explode(' to ', $filterTanggal);
                return $query->whereBetween('tanggal', [$dates[0], $dates[1]]);
            })
            ->get();

        $totalSampah = $pieChartData->sum('total_sampah');
        foreach ($pieChartData as $data) {
            $data->percentage = ($data->total_sampah / $totalSampah) * 100;
        }

        // Data for bar chart: total amount of waste per category in each province
        $barChartData = PerhitunganSampah::join('saranas','perhitungan_sampahs.sarana_id_sarana','=','saranas.id_sarana')->select('saranas.provinsi_id_provinsi', 'kategori_id_kategori', FacadesDB::raw('SUM(jumlah_sampah) as total_sampah'))
            ->groupBy('saranas.provinsi_id_provinsi', 'kategori_id_kategori')
            ->where('jumlah_sampah', '!=', null)
            ->with('provinsi', 'kategori')
            ->when($filterTanggal, function ($query) use ($filterTanggal) {
                $dates = explode(' to ', $filterTanggal);
                return $query->whereBetween('tanggal', [$dates[0], $dates[1]]);
            })
            ->when($filterProvinsi, function ($query) use ($filterProvinsi) {
                return $query->where('provinsi_id_provinsi', $filterProvinsi);
            })
            ->when($filterKategori, function ($query) use ($filterKategori) {
                return $query->where('kategori_id_kategori', $filterKategori);
            })
            ->get()
            ->groupBy('provinsi_id_provinsi');


        return view('pages.dashboard.dashboard', compact('users', 'provinsis', 'kategoris', 'stackedBarData', 'pieChartData', 'barChartData'));
    }

}
