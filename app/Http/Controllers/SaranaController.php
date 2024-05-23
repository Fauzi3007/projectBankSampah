<?php

namespace App\Http\Controllers;

use App\Models\PenggunaSarana;
use App\Models\Sarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('pages.sarana.create');
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
        return view('pages.sarana.edit', compact('sarana'));
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
