<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinsis = Provinsi::all();
        return view('provinsi.index', compact('provinsis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('provinsi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_provinsi' => 'required|string',
        ]);

        Provinsi::create($request->all());

        return redirect()->route('provinsi.index')
            ->with('success', 'Provinsi created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provinsi $provinsi)
    {
        return view('provinsi.show', compact('provinsi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provinsi $provinsis)
    {
        return view('provinsi.edit', compact('provinsis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provinsi $provinsis)
    {
        $request->validate([
            'nama_provinsi' => 'required|string',
        ]);

        $provinsis->update($request->all());

        return redirect()->route('provinsi.index')
            ->with('success', 'Provinsi updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provinsi $provinsis)
    {
        $provinsis->delete();

        return redirect()->route('provinsi.index')
            ->with('success', 'Provinsi deleted successfully');
    }
}
