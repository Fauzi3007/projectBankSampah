<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mitras = Mitra::all();
        return view('pages.mitra.index', compact('mitras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.mitra.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_admin' => ['required', 'max:50'],
            'no_hp' => ['required', 'max:15'],
        ]);

        Mitra::create($validatedData);

        return redirect()->route('mitra.index')->with('success', 'Mitra created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mitra $mitra)
    {
        return view('pages.mitra.show', compact('mitra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mitra $mitra)
    {
        return view('pages.mitra.edit', compact('mitra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mitra $mitra)
    {
        $validatedData = $request->validate([
            'nama_admin' => ['required', 'max:50'],
            'no_hp' => ['required', 'max:15'],
        ]);

        $mitra->update($validatedData);

        return redirect()->route('mitra.index')->with('success', 'Mitra updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mitra $mitra)
    {
        $mitra->delete();

        return redirect()->route('mitra.index')->with('success', 'Mitra deleted successfully.');
    }
}
