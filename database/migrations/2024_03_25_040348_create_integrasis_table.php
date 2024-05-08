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
        Schema::create('integrasis', function (Blueprint $table) {
            $table->increments('id_integrasi');
            $table->string('nama_aplikasi',50);
            $table->string('deskripsi',100);
            $table->string('url_endpoint',50);
            $table->string('token_akses',100);
            $table->string('kunci_enkripsi',100);
            $table->integer('request_timeout');
            $table->string('format_data',20);
            $table->string('kunci_api',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrasis');
    }
};
