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
        Schema::create('saranas', function (Blueprint $table) {
            $table->increments('id_sarana');
            $table->string('nama_sarana', 50);
            $table->string('alamat_sarana', 100);
            $table->unsignedInteger('provinsi_id_provinsi')->references('id_provinsi')->on('provinsis');
            $table->string('jenis_sarana', 50)->nullable();
            $table->unsignedInteger('nama_admin')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saranas');
    }
};
