<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelUploadController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenggunaSaranaController;
use App\Http\Controllers\PerhitunganSampahController;
use App\Http\Controllers\SaranaController;
use Illuminate\Support\Facades\Response;


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
    Route::resource('pengguna_sarana', PenggunaSaranaController::class)->middleware('admin');
    Route::post('excel-upload', [ExcelUploadController::class, 'index'])->name('excel.upload');

    Route::fallback(function() {
        return view('pages/utility/404');
    });

    Route::get('/download-excel', function () {
        $file = public_path('/excel/template.xlsx');

        return Response::download($file, 'template.xlsx');
    })->name('download.excel');
});
