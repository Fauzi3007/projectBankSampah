<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('kategoris')->insert([
            ['nama_kategori' => 'plastik'],
            ['nama_kategori' => 'kertas'],
            ['nama_kategori' => 'logam'],
            ['nama_kategori' => 'kaca'],
            ['nama_kategori' => 'kain'],
            ['nama_kategori' => 'lainnya']
        ]);

        DB::table('subkategoris')->insert([
            ['nama_subkategori' => 'hdpe', 'kategori_id_kategori' => 1],
            ['nama_subkategori' => 'ldpe', 'kategori_id_kategori' => 1],
            ['nama_subkategori' => 'pp', 'kategori_id_kategori' => 1],
            ['nama_subkategori' => 'ps', 'kategori_id_kategori' => 1],
            ['nama_subkategori' => 'pet', 'kategori_id_kategori' => 1],
            ['nama_subkategori' => 'pvc', 'kategori_id_kategori' => 1],
            ['nama_subkategori' => 'kertas', 'kategori_id_kategori' => 2],
            ['nama_subkategori' => 'karton', 'kategori_id_kategori' => 2],
            ['nama_subkategori' => 'besi', 'kategori_id_kategori' => 3],
            ['nama_subkategori' => 'aluminium', 'kategori_id_kategori' => 3],
            ['nama_subkategori' => 'kaca', 'kategori_id_kategori' => 4],
            ['nama_subkategori' => 'kain', 'kategori_id_kategori' => 5],
            ['nama_subkategori' => 'lainnya', 'kategori_id_kategori' => 6]
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('kategoris')->whereIn('nama_kategori', ['plastik', 'kertas', 'logam', 'kaca', 'kain', 'lainnya'])->delete();
        DB::table('subkategoris')->whereIn('nama_subkategori', ['hdpe', 'ldpe', 'pp', 'ps', 'pet', 'pvc', 'kertas', 'karton', 'besi', 'aluminium', 'kaca', 'kain', 'lainnya'])->delete();
    }
};
