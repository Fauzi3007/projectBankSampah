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
        DB::table('users')->insert([
            'email' => 'superadmin@gmail.com',
            'name' => 'Super Admin',
            'role' => 'super admin',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'email' => 'pengguna@gmail.com',
            'name' => 'Pengguna',
            'role' => 'pengguna',
            'password' => bcrypt('password'),
        ]);

        DB::table('pengguna_saranas')->insert([
            'nama_pengguna' => 'Super Admin',
            'no_hp' => '+6281234567890',
            'id_akun' => 1,
        ]);

        DB::table('pengguna_saranas')->insert([
            'nama_pengguna' => 'Admin',
            'no_hp' => '+6281234567890',
            'id_akun' => 2,
        ]);

        DB::table('pengguna_saranas')->insert([
            'nama_pengguna' => 'Pengguna',
            'no_hp' => '+6281234567890',
            'id_akun' => 3,
        ]);
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->where('email', 'superadmin@gmail,com')->delete();
        DB::table('users')->where('email', 'admin@gmail,com')->delete();
        DB::table('users')->where('email', 'pengguna@gmail,com')->delete();
        DB::table('pengguna_saranas')->whereIn('nama_pengguna', ['Super Admin', 'Admin', 'Pengguna'])->delete();
    }
};
