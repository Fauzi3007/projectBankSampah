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
        $provinsi = [
            ['nama_provinsi' => 'aceh'],
            ['nama_provinsi' => 'sumatera utara'],
            ['nama_provinsi' => 'sumatera barat'],
            ['nama_provinsi' => 'riau'],
            ['nama_provinsi' => 'kepulauan riau'],
            ['nama_provinsi' => 'jambi'],
            ['nama_provinsi' => 'sumatera selatan'],
            ['nama_provinsi' => 'bangka belitung'],
            ['nama_provinsi' => 'bengkulu'],
            ['nama_provinsi' => 'lampung'],
            ['nama_provinsi' => 'dki jakarta'],
            ['nama_provinsi' => 'jawa barat'],
            ['nama_provinsi' => 'banten'],
            ['nama_provinsi' => 'jawa tengah'],
            ['nama_provinsi' => 'di yogyakarta'],
            ['nama_provinsi' => 'jawa timur'],
            ['nama_provinsi' => 'bali'],
            ['nama_provinsi' => 'nusa tenggara barat'],
            ['nama_provinsi' => 'nusa tenggara timur'],
            ['nama_provinsi' => 'kalimantan barat'],
            ['nama_provinsi' => 'kalimantan tengah'],
            ['nama_provinsi' => 'kalimantan selatan'],
            ['nama_provinsi' => 'kalimantan timur'],
            ['nama_provinsi' => 'kalimantan utara'],
            ['nama_provinsi' => 'sulawesi utara'],
            ['nama_provinsi' => 'gorontalo'],
            ['nama_provinsi' => 'sulawesi tengah'],
            ['nama_provinsi' => 'sulawesi barat'],
            ['nama_provinsi' => 'sulawesi selatan'],
            ['nama_provinsi' => 'sulawesi tenggara'],
            ['nama_provinsi' => 'maluku'],
            ['nama_provinsi' => 'maluku utara'],
            ['nama_provinsi' => 'papua'],
            ['nama_provinsi' => 'papua barat'],
            ['nama_provinsi' => 'papua tengah'],
            ['nama_provinsi' => 'papua pegunungan'],
            ['nama_provinsi' => 'papua selatan'],
            ['nama_provinsi' => 'papua barat daya'],
        ];


        DB::table('provinsis')->insert($provinsi);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('provinsis')->truncate();
    }
};
