<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perhitungan_sampahs', function (Blueprint $table) {
            $table->increments('id_perhitungan_sampah');
            $table->date('tanggal');
            $table->unsignedInteger('kategori_id_kategori')->references('id_kategori')->on('kategoris');
            $table->integer('jumlah_sampah');
            $table->unsignedInteger('sarana_id_sarana')->references('id_sarana')->on('saranas');
            $table->unsignedInteger('user_id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perhitungan_sampahs');
    }
};
