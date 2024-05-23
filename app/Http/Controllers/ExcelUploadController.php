<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\PerhitunganSampah;
use App\Models\Subkategori;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;



class ExcelUploadController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->filled('tanggal') ? $request->input('tanggal') : Carbon::now();
        $sarana = $request->filled('sarana_id_sarana') ? $request->input('sarana_id_sarana') : 0;

        $request->validate([
            'excel_file' => 'required',
        ]);

        $file = $request->file('excel_file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();

        $row = 4;
        $totalRow = $worksheet->getHighestRow();
        while ($worksheet->getCell('A' . $row)->getValue() != 'TOTAL' && $row <= $totalRow) {
            $kategori = strtolower($worksheet->getCell('B' . $row)->getValue());
            $subkategori = strtolower($worksheet->getCell('C' . $row)->getValue());
            $jumlahSampah = $worksheet->getCell('D' . $row)->getValue();

            $existingKategori = Kategori::whereRaw('LOWER(nama_kategori) = ?', [$kategori])->first();
            if (!$existingKategori) {
            $existingKategori = Kategori::create([
                'nama_kategori' => $kategori,
            ]);
            }

            $existingSubkategori = Subkategori::whereRaw('LOWER(nama_subkategori) = ?', [$subkategori])->first();
            if (!$existingSubkategori) {
            $existingSubkategori = Subkategori::create([
                'nama_subkategori' => $subkategori,
            ]);
            }

            PerhitunganSampah::create([
            'tanggal' => $tanggal,
            'sarana_id_sarana' => $sarana,
            'kategori_id_kategori' => $existingKategori->id_kategori,
            'subkategori_id_subkategori' => $existingSubkategori->id_subkategori,
            'jumlah_sampah' => $jumlahSampah,
            'user_id_user' => Auth::user()->id,
            ]);

            $row++;
        }

        return redirect()->route('perhitungan_sampah.index')->with('success', 'Data berhasil ditambahkan');

    }
}
