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
            ['nama_provinsi' => 'Aceh'],
            ['nama_provinsi' => 'Sumatera Utara'],
            ['nama_provinsi' => 'Sumatera Barat'],
            ['nama_provinsi' => 'Riau'],
            ['nama_provinsi' => 'Kepulauan Riau'],
            ['nama_provinsi' => 'Jambi'],
            ['nama_provinsi' => 'Sumatera Selatan'],
            ['nama_provinsi' => 'Bangka Belitung'],
            ['nama_provinsi' => 'Bengkulu'],
            ['nama_provinsi' => 'Lampung'],
            ['nama_provinsi' => 'DKI Jakarta'],
            ['nama_provinsi' => 'Jawa Barat'],
            ['nama_provinsi' => 'Banten'],
            ['nama_provinsi' => 'Jawa Tengah'],
            ['nama_provinsi' => 'DI Yogyakarta'],
            ['nama_provinsi' => 'Jawa Timur'],
            ['nama_provinsi' => 'Bali'],
            ['nama_provinsi' => 'Nusa Tenggara Barat'],
            ['nama_provinsi' => 'Nusa Tenggara Timur'],
            ['nama_provinsi' => 'Kalimantan Barat'],
            ['nama_provinsi' => 'Kalimantan Tengah'],
            ['nama_provinsi' => 'Kalimantan Selatan'],
            ['nama_provinsi' => 'Kalimantan Timur'],
            ['nama_provinsi' => 'Kalimantan Utara'],
            ['nama_provinsi' => 'Sulawesi Utara'],
            ['nama_provinsi' => 'Gorontalo'],
            ['nama_provinsi' => 'Sulawesi Tengah'],
            ['nama_provinsi' => 'Sulawesi Barat'],
            ['nama_provinsi' => 'Sulawesi Selatan'],
            ['nama_provinsi' => 'Sulawesi Tenggara'],
            ['nama_provinsi' => 'Maluku'],
            ['nama_provinsi' => 'Maluku Utara'],
            ['nama_provinsi' => 'Papua'],
            ['nama_provinsi' => 'Papua Barat'],
            ['nama_provinsi' => 'Papua Tengah'],
            ['nama_provinsi' => 'Papua Pegunungan'],
            ['nama_provinsi' => 'Papua Selatan'],
            ['nama_provinsi' => 'Papua Barat Daya'],
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
