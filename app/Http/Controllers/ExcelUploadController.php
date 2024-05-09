<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\PerhitunganSampah;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;



class ExcelUploadController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->filled('tanggal') ? $request->input('tanggal') : Carbon::now();
        $sarana = $request->filled('sarana_id_sarana') ? $request->input('sarana_id_sarana') : 0;

        $request->validate([
            'file_excel' => 'required|file|mimes:xls,xlsx',
        ]);

        $file = $request->file('file_excel');
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();



        $row = 4;
        $totalRow = $worksheet->getHighestRow();
        while ($worksheet->getCell('A' . $row)->getValue() != 'TOTAL' && $row <= $totalRow) {
            $kategori = strtolower($worksheet->getCell('B' . $row)->getValue());
            $jumlahSampah = $worksheet->getCell('C' . $row)->getValue();

            $existingKategori = PerhitunganSampah::whereRaw('LOWER(nama_kategori) = ?', [$kategori])->first();
            if (!$existingKategori) {
            $existingKategori = Kategori::create([
                'nama_kategori' => $kategori,
            ]);
            }

            PerhitunganSampah::create([
            'tanggal' => $tanggal,
            'sarana_id_sarana' => $sarana,
            'kategori_id_kategori' => $existingKategori->id_kategori,
            'jumlah_sampah' => $jumlahSampah,
            ]);

            $row++;
        }

        return redirect()->route('perhitungan_sampah.index')->with('success', 'Data berhasil ditambahkan');

    }
}
