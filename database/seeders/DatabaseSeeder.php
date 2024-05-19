<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Mitra;
use App\Models\PenggunaSarana;
use App\Models\PerhitunganSampah;
use App\Models\Sarana;
use App\Models\User;
use Database\Factories\SubkategoriFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'admin@gmail.com',
            'role' => 'admin'
        ]);
        User::factory()->create([
            'email' => 'superadmin@gmail.com',
            'role' => 'admin'
        ]);
        User::factory()->create([
            'email' => 'pengguna@gmail.com',
            'role' => 'pengguna'
        ]);

        Kategori::factory()->count(10)->create();
        PenggunaSarana::factory()->count(10)->create();
        PerhitunganSampah::factory()->count(10)->create();
        Sarana::factory()->count(10)->create();
        SubkategoriFactory::new()->count(10)->create();

    }
}
