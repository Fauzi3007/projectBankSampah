<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\PerhitunganSampah;
use App\Models\Provinsi;
use App\Models\Sarana;
use App\Models\Subkategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerhitunganSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saranas = Sarana::select('id_sarana', 'nama_sarana')->get();
        $kategoris = Kategori::all();
        $subkategoris = Subkategori::all();
        $provinsis  = Provinsi::all();
        $users = Auth::user()->role == 'admin' || Auth::user()->role == 'super admin' ? User::all() : User::where('role', 'pengguna')->get();

        $perhitunganSampah = PerhitunganSampah::paginate(5);
        return view('pages.perhitungan_sampah.index', compact('perhitunganSampah', 'saranas', 'kategoris', 'subkategoris', 'users'));
    }

    /**
     * Filter the listing of resources based on the given criteria.
     */
    public function filter(Request $request)
    {
        // Fetch initial data if needed
        $saranas = Sarana::select('id_sarana', 'nama_sarana')->get();
        $kategoris = Kategori::all();
        $subkategoris = Subkategori::all();
        $users = Auth::user()->role == 'admin' || Auth::user()->role == 'super admin' ? User::all() : User::where('role', 'pengguna')->get();
        $provinsis = Provinsi::all();

        // Retrieve filter parameters from request
        $tanggal = $request->input('tanggal');
        $jumlah_sampah = $request->input('operator');
        $sarana_id_sarana = $request->input('sarana_id_sarana');
        $kategori_id_kategori = $request->input('selectedJenis');
        $subkategori_id_subkategori = $request->input('selectedSubjenis');
        $user_id_user = $request->input('selectedUser');
        $provinsi_id_provinsi = $request->input('selectedProvinsi');

        // Initial query setup
        $perhitunganSampah = PerhitunganSampah::join('saranas', 'perhitungan_sampahs.sarana_id_sarana', '=', 'saranas.id_sarana');

        // Apply filters
        if ($tanggal) {
            $dates = explode(' - ', $tanggal);
            if (count($dates) > 1) {

                $carbonDate1 = \Carbon\Carbon::createFromFormat('M d, Y', $dates[0]);
                $carbonDate2 = \Carbon\Carbon::createFromFormat('M d, Y', $dates[1]);
                $perhitunganSampah->whereBetween('tanggal', [$carbonDate1, $carbonDate2]);
            } else {
                $carbonDate1 = \Carbon\Carbon::createFromFormat('M d, Y', $dates[0]);

                $perhitunganSampah->where('tanggal', $carbonDate1);
            }
        }
        if ($jumlah_sampah) {
            $perhitunganSampah->orderBy('jumlah_sampah', $jumlah_sampah);
        }
        if ($sarana_id_sarana) {
            $perhitunganSampah->whereIn('sarana_id_sarana', $sarana_id_sarana);
        }
        if ($kategori_id_kategori) {
            $perhitunganSampah->whereIn('kategori_id_kategori', $kategori_id_kategori);
        }
        if ($subkategori_id_subkategori) {
            $perhitunganSampah->whereIn('subkategori_id_subkategori', $subkategori_id_subkategori);
        }
        if ($user_id_user) {
            $perhitunganSampah->whereIn('user_id_user', $user_id_user);
        }
        if ($provinsi_id_provinsi) {
            $perhitunganSampah->whereIn('provinsi_id_provinsi', $provinsi_id_provinsi);
        }

        // Perform pagination and return results
        $perhitunganSampah = $perhitunganSampah->paginate(5);


        // Return data to view or process further
        return view('pages.perhitungan_sampah.index', compact('perhitunganSampah', 'saranas', 'kategoris', 'subkategoris', 'users', 'provinsis'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $subkategoris = Subkategori::all();
        $saranas = Sarana::all();
        return view('pages.perhitungan_sampah.create', compact('kategoris', 'saranas', 'subkategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah_sampah' => 'required|integer',
            'sarana_id_sarana' => 'required|integer',
            'kategori_id_kategori' => 'required|integer',
            'subkategori_id_subkategori' => 'required|integer',
            'user_id_user' => 'required',

        ]);

        PerhitunganSampah::create($validated);
        return redirect()->route('perhitungan_sampah.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PerhitunganSampah $perhitunganSampah)
    {
        return view('pages.perhitungan_sampah.show', compact('perhitunganSampah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PerhitunganSampah $perhitunganSampah)
    {
        $kategoris = Kategori::all();
        $subkategoris = Subkategori::all();
        $saranas = Sarana::all();
        return view('pages.perhitungan_sampah.edit', compact('perhitunganSampah', 'kategoris', 'saranas', 'subkategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PerhitunganSampah $perhitunganSampah)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah_sampah' => 'required|integer',
            'sarana_id_sarana' => 'required|integer',
            'kategori_id_kategori' => 'required|integer',
            'subkategori_id_subkategori' => 'required|integer',
            'user_id_user' => 'required',
        ]);

        $perhitunganSampah->update($validated);
        return redirect()->route('perhitungan_sampah.index')->with('success', 'Data berhasil diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerhitunganSampah $perhitunganSampah)
    {
        $perhitunganSampah->delete();
        return redirect()->route('perhitungan_sampah.index')->with('success', 'Data berhasil dihapus');
    }
}
