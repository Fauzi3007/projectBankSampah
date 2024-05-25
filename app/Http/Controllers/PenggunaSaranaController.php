<?php

namespace App\Http\Controllers;

use App\Models\PenggunaSarana;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenggunaSaranaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna_saranas = PenggunaSarana::orderBy('created_at', 'desc')->paginate(5);
        return view('pages.pengguna_sarana.index', compact('pengguna_saranas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pengguna_sarana.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pengguna' => ['required', 'max:50'],
            'no_hp' => ['required', 'max:20'],
            'email' => ['required', 'max:50'],
            'password' => ['required', 'max:50'],
            'role' => ['required', 'max:20'],

        ]);

        User::create([
            'name' => $validatedData['nama_pengguna'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        PenggunaSarana::create([
            'id_akun'=> User::latest()->first()->id,
            'nama_pengguna' => $validatedData['nama_pengguna'],
            'no_hp' => $validatedData['no_hp'],
        ]);



        return redirect()->route('pengguna_sarana.index')->with('success', 'Pengguna Sarana created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenggunaSarana $pengguna_sarana)
    {
        return view('pages.pengguna_sarana.show', compact('pengguna_sarana'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenggunaSarana $pengguna_sarana)
    {
        return view('pages.pengguna_sarana.edit', compact('pengguna_sarana'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenggunaSarana $pengguna_sarana)
    {
        $validatedData = $request->validate([
            'nama_pengguna' => ['required', 'max:50'],
            'no_hp' => ['required', 'max:20'],
            'email' => ['required', 'max:50'],
            'password' => ['required', 'max:50'],
            'role' => ['required', 'max:20'],

        ]);

        $pengguna_sarana->user->update([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'name' => $validatedData['nama_pengguna'],
            'role' => $validatedData['role'],
        ]);

        $pengguna_sarana->update([
            'id_akun'=> $pengguna_sarana->user->id,
            'nama_pengguna' => $validatedData['nama_pengguna'],
            'no_hp' => $validatedData['no_hp'],
        ]);

        return redirect()->route('pengguna_sarana.index')->with('success', 'Pengguna Sarana updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenggunaSarana $pengguna_sarana)
    {
        $pengguna_sarana->delete();

        return redirect()->route('pengguna_sarana.index')->with('success', 'Pengguna Sarana deleted successfully.');
    }
}
