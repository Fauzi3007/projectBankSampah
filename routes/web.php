<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelUploadController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenggunaSaranaController;
use App\Http\Controllers\PerhitunganSampahController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\SaranaController;
use App\Http\Controllers\SubkategoriController;
use App\Models\PerhitunganSampah;
use App\Models\Sarana;
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
    Route::post('sarana', [SaranaController::class, 'store'])->name('sarana.store')->middleware('admin');
    Route::get('sarana/create', [SaranaController::class, 'create'])->name('sarana.create')->middleware('admin');
    Route::get('sarana/{sarana}', [SaranaController::class, 'show'])->name('sarana.show')->middleware('admin');
    Route::get('sarana/{sarana}/edit', [SaranaController::class, 'edit'])->name('sarana.edit')->middleware('admin');
    Route::put('sarana/{sarana}', [SaranaController::class, 'update'])->name('sarana.update')->middleware('admin');
    Route::delete('sarana/{sarana}', [SaranaController::class, 'destroy'])->name('sarana.destroy')->middleware('admin');

    // Kategori
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::get('kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::get('kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Pengguna Sarana
    Route::get('pengguna_sarana', [PenggunaSaranaController::class, 'index'])->name('pengguna_sarana.index')->middleware('admin');
    Route::post('pengguna_sarana', [PenggunaSaranaController::class, 'store'])->name('pengguna_sarana.store')->middleware('admin');
    Route::get('pengguna_sarana/create', [PenggunaSaranaController::class, 'create'])->name('pengguna_sarana.create')->middleware('admin');
    Route::get('pengguna_sarana/{pengguna_sarana}', [PenggunaSaranaController::class, 'show'])->name('pengguna_sarana.show')->middleware('admin');
    Route::get('pengguna_sarana/{pengguna_sarana}/edit', [PenggunaSaranaController::class, 'edit'])->name('pengguna_sarana.edit')->middleware('admin');
    Route::put('pengguna_sarana/{pengguna_sarana}', [PenggunaSaranaController::class, 'update'])->name('pengguna_sarana.update')->middleware('admin');
    Route::delete('pengguna_sarana/{pengguna_sarana}', [PenggunaSaranaController::class, 'destroy'])->name('pengguna_sarana.destroy')->middleware('admin');

    Route::post('excel-upload', [ExcelUploadController::class, 'index'])->name('excel.upload');

    // Provinsi
    Route::get('provinsi', [ProvinsiController::class, 'index'])->name('provinsi.index')->middleware('admin');
    Route::post('provinsi', [ProvinsiController::class, 'store'])->name('provinsi.store')->middleware('admin');
    Route::get('provinsi/create', [ProvinsiController::class, 'create'])->name('provinsi.create')->middleware('admin');
    Route::get('provinsi/{provinsi}', [ProvinsiController::class, 'show'])->name('provinsi.show')->middleware('admin');
    Route::get('provinsi/{provinsi}/edit', [ProvinsiController::class, 'edit'])->name('provinsi.edit')->middleware('admin');
    Route::put('provinsi/{provinsi}', [ProvinsiController::class, 'update'])->name('provinsi.update')->middleware('admin');
    Route::delete('provinsi/{provinsi}', [ProvinsiController::class, 'destroy'])->name('provinsi.destroy')->middleware('admin');

    // Subkategori
    Route::get('subkategori', [SubkategoriController::class, 'index'])->name('subkategori.index');
    Route::post('subkategori', [SubkategoriController::class, 'store'])->name('subkategori.store');
    Route::get('subkategori/create', [SubkategoriController::class, 'create'])->name('subkategori.create');
    Route::get('subkategori/{subkategori}', [SubkategoriController::class, 'show'])->name('subkategori.show');
    Route::get('subkategori/{subkategori}/edit', [SubkategoriController::class, 'edit'])->name('subkategori.edit');
    Route::put('subkategori/{subkategori}', [SubkategoriController::class, 'update'])->name('subkategori.update');
    Route::delete('subkategori/{subkategori}', [SubkategoriController::class, 'destroy'])->name('subkategori.destroy');

    // Filter Data
    Route::post('/filter-data', [DashboardController::class, 'filterData'])->name('filter');
    Route::post('/filter-sampah', [PerhitunganSampahController::class, 'filter'])->name('filter-sampah');
    Route::post('/filter-sarana', [SaranaController::class, 'filter'])->name('filter-sarana');



    Route::fallback(function() {
        return view('pages/utility/404');
    });

    Route::get('/download-excel', function () {
        $file = public_path('/excel/template.xlsx');

        return Response::download($file, 'template.xlsx');
    })->name('download.excel');
});
