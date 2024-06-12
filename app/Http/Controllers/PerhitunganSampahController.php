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

        $saranas = Sarana::select('id_sarana', 'nama_sarana')->get();
        $kategoris = Kategori::all();
        $subkategoris = Subkategori::all();
        $users = Auth::user()->role == 'admin' || Auth::user()->role == 'super admin' ? User::all() : User::where('role', 'pengguna')->get();
        $provinsis = Provinsi::all();

        $tanggal = $request->input('tanggal');
        $jumlah_sampah = $request->input('operator');
        $sarana_id_sarana = $request->input('sarana_id_sarana');
        $kategori_id_kategori = $request->input('selectedJenis');
        $subkategori_id_subkategori = $request->input('selectedSubjenis');
        $user_id_user = $request->input('selectedUser');
        $provinsi_id_provinsi = $request->input('selectedProvinsi');

        $perhitunganSampah = PerhitunganSampah::join('saranas','perhitungan_sampahs.sarana_id_sarana','=','saranas.id_sarana')->getQuery();

        $perhitunganSampah->where(function ($query) use ($tanggal, $jumlah_sampah, $sarana_id_sarana, $kategori_id_kategori, $subkategori_id_subkategori, $user_id_user, $provinsi_id_provinsi) {
            if ($tanggal) {
                $dates = explode(' to ', $tanggal);
                if (count($dates) > 1) {
                    return $query->whereBetween('tanggal', [$dates[0], $dates[1]]);
                } else {
                    return $query->where('tanggal', $dates[0]);
                }
            }
            if ($jumlah_sampah) {
                $query->orderBy('jumlah_sampah', $jumlah_sampah);
            }
            if ($sarana_id_sarana) {
                $query->whereIn('sarana_id_sarana', $sarana_id_sarana);
            }
            if ($kategori_id_kategori) {
                $query->whereIn('kategori_id_kategori', $kategori_id_kategori);
            }
            if ($subkategori_id_subkategori) {
                $query->whereIn('subkategori_id_subkategori', $subkategori_id_subkategori);
            }
            if ($user_id_user) {
                $query->whereIn('user_id_user', $user_id_user);
            }
            if ($provinsi_id_provinsi) {
                $query->whereIn('provinsi_id_provinsi', $provinsi_id_provinsi);
            }
        });

        $perhitunganSampah = $perhitunganSampah->paginate(5);

        return view('pages.perhitungan_sampah.index', compact('perhitunganSampah', 'saranas', 'kategoris', 'subkategoris', 'users'));
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
