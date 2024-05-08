<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataFeed;
use App\Models\PerhitunganSampah;

class DashboardController extends Controller
{
    public function index()
    {
        $perhitunganSampah = PerhitunganSampah::all();
        return view('pages/dashboard/dashboard', compact('perhitunganSampah'));
    }
}