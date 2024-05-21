<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Kota;
use App\Models\Mitra;
use App\Models\PenggunaSarana;
use App\Models\PerhitunganSampah;
use App\Models\Provinsi;
use App\Models\Sarana;
use App\Models\Subkategori;
use App\Models\User;
use Database\Factories\KotaFactory;
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


        Kategori::factory()->create(
            ['nama_kategori' => 'plastik',]
        );
        Kategori::factory()->create(
            ['nama_kategori' => 'kertas',]
        );
        Kategori::factory()->create(
            ['nama_kategori' => 'logam',]
        );
        Kategori::factory()->create(
            ['nama_kategori' => 'kaca',]
        );
        Kategori::factory()->create(
            ['nama_kategori' => 'kain',]
        );
        Kategori::factory()->create(
            ['nama_kategori' => 'lainnya',]
        );



        Subkategori::factory()->create(
            ['nama_subkategori' => 'hdpe', 'kategori_id_kategori' => 1]
        );
        Subkategori::factory()->create(
            ['nama_subkategori' => 'ldpe', 'kategori_id_kategori' => 1]
        );
        Subkategori::factory()->create(
            ['nama_subkategori' => 'pp', 'kategori_id_kategori' => 1]
        );
        Subkategori::factory()->create(
            ['nama_subkategori' => 'ps', 'kategori_id_kategori' => 1]
        );
        Subkategori::factory()->create(
            ['nama_subkategori' => 'pet', 'kategori_id_kategori' => 1]
        );
        Subkategori::factory()->create(
            ['nama_subkategori' => 'pvc', 'kategori_id_kategori' => 1]
        );
        Subkategori::factory()->create(
            ['nama_subkategori' => 'kertas', 'kategori_id_kategori' => 2]
        );
        Subkategori::factory()->create(
            ['nama_subkategori' => 'karton', 'kategori_id_kategori' => 2]
        );
        Subkategori::factory()->create(
            ['nama_subkategori' => 'besi', 'kategori_id_kategori' => 3]
        );
        Subkategori::factory()->create(
            ['nama_subkategori' => 'aluminium', 'kategori_id_kategori' => 3]
        );
        Subkategori::factory()->create(
            ['nama_subkategori' => 'kaca', 'kategori_id_kategori' => 4]
        );
        Subkategori::factory()->create(
            ['nama_subkategori' => 'kain', 'kategori_id_kategori' => 5]
        );
        Subkategori::factory()->create(
            ['nama_subkategori' => 'lainnya', 'kategori_id_kategori' => 6]
        );

        PenggunaSarana::factory()->count(10)->create();
        PerhitunganSampah::factory()->count(10)->create();
        Sarana::factory()->count(10)->create();
        // Provinsi::factory()->count(10)->create();
        // Kota::factory()->count(10)->create();


    }
}
