<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PerhitunganSampahController;
use App\Http\Controllers\SaranaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

   

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('perhitungan_sampah', PerhitunganSampahController::class);
    Route::resource('sarana', SaranaController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('mitra', MitraController::class);
    
    Route::fallback(function() {
        return view('pages/utility/404');
    });    
});
