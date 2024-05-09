<?php

namespace App\Http\Controllers;

use App\Models\PenggunaSarana;
use App\Models\Sarana;
use Illuminate\Http\Request;

class SaranaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saranas = Sarana::paginate(5);
        return view('pages.sarana.index', compact('saranas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengguna_saranas = PenggunaSarana::all();
        return view('pages.sarana.create', compact('pengguna_saranas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_sarana' => ['required', 'max:50'],
            'alamat_sarana' => ['required', 'max:100'],
            'jenis_sarana' => ['required', 'max:50'],
            'pengguna_sarana_id_pengguna_sarana' => ['required'],
        ]);

        Sarana::create($validatedData);

        return redirect()->route('sarana.index')->with('success', 'Sarana created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sarana $sarana)
    {

        return view('pages.sarana.show', compact('sarana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sarana $sarana)
    {
        $pengguna_saranas = PenggunaSarana::all();
        return view('pages.sarana.edit', compact('sarana', 'pengguna_saranas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sarana $sarana)
    {
        $validatedData = $request->validate([
            'nama_sarana' => ['required', 'max:50'],
            'alamat_sarana' => ['required', 'max:100'],
            'jenis_sarana' => ['required', 'max:50'],
            'pengguna_sarana_id_pengguna_sarana' => ['required'],
        ]);

        $sarana->update($validatedData);

        return redirect()->route('sarana.index')->with('success', 'Sarana updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sarana $sarana)
    {
        $sarana->delete();

        return redirect()->route('sarana.index')->with('success', 'Sarana deleted successfully.');
    }
}
