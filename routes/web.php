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
    // Perhitungan Sampah
    Route::get('perhitungan_sampah', [PerhitunganSampahController::class, 'index'])->name('perhitungan_sampah.index');
    Route::post('perhitungan_sampah', [PerhitunganSampahController::class, 'store'])->name('perhitungan_sampah.store');
    Route::get('perhitungan_sampah/create', [PerhitunganSampahController::class, 'create'])->name('perhitungan_sampah.create');
    Route::get('perhitungan_sampah/{perhitungan_sampah}', [PerhitunganSampahController::class, 'show'])->name('perhitungan_sampah.show');
    Route::get('perhitungan_sampah/{perhitungan_sampah}/edit', [PerhitunganSampahController::class, 'edit'])->name('perhitungan_sampah.edit');
    Route::put('perhitungan_sampah/{perhitungan_sampah}', [PerhitunganSampahController::class, 'update'])->name('perhitungan_sampah.update');
    Route::delete('perhitungan_sampah/{perhitungan_sampah}', [PerhitunganSampahController::class, 'destroy'])->name('perhitungan_sampah.destroy');

    // Sarana
    Route::get('sarana', [SaranaController::class, 'index'])->name('sarana.index');
    Route::post('sarana', [SaranaController::class, 'store'])->name('sarana.store');
    Route::get('sarana/create', [SaranaController::class, 'create'])->name('sarana.create');
    Route::get('sarana/{sarana}', [SaranaController::class, 'show'])->name('sarana.show');
    Route::get('sarana/{sarana}/edit', [SaranaController::class, 'edit'])->name('sarana.edit');
    Route::put('sarana/{sarana}', [SaranaController::class, 'update'])->name('sarana.update');
    Route::delete('sarana/{sarana}', [SaranaController::class, 'destroy'])->name('sarana.destroy');

    // Kategori
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::get('kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::get('kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Pengguna Sarana
    Route::get('pengguna_sarana', [PenggunaSaranaController::class, 'index'])->name('pengguna_sarana.index');
    Route::post('pengguna_sarana', [PenggunaSaranaController::class, 'store'])->name('pengguna_sarana.store');
    Route::get('pengguna_sarana/create', [PenggunaSaranaController::class, 'create'])->name('pengguna_sarana.create');
    Route::get('pengguna_sarana/{pengguna_sarana}', [PenggunaSaranaController::class, 'show'])->name('pengguna_sarana.show');
    Route::get('pengguna_sarana/{pengguna_sarana}/edit', [PenggunaSaranaController::class, 'edit'])->name('pengguna_sarana.edit');
    Route::put('pengguna_sarana/{pengguna_sarana}', [PenggunaSaranaController::class, 'update'])->name('pengguna_sarana.update');
    Route::delete('pengguna_sarana/{pengguna_sarana}', [PenggunaSaranaController::class, 'destroy'])->name('pengguna_sarana.destroy')->middleware('admin');
    Route::post('excel-upload', [ExcelUploadController::class, 'index'])->name('excel.upload');

    Route::fallback(function() {
        return view('pages/utility/404');
    });

    Route::get('/download-excel', function () {
        $file = public_path('/excel/template.xlsx');

        return Response::download($file, 'template.xlsx');
    })->name('download.excel');
});
