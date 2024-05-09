<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PerhitunganSampah;

class DashboardController extends Controller
{
    public function index()
    {
        $perhitunganSampah = PerhitunganSampah::orderBy('jumlah_sampah', 'desc')->paginate(8);
        return view('pages/dashboard/dashboard', compact('perhitunganSampah'));
    }
}
