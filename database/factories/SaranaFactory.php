<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sarana>
 */
class SaranaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_sarana' => $this->faker->name("id_ID"),
            'alamat_sarana' => $this->faker->address("id_ID"),
            'jenis_sarana' => $this->faker->randomElement(['Bank Sampah', 'Pembuangan Akhir', 'Tong Sampah']),
            'provinsi_id_provinsi' => \App\Models\Provinsi::factory()->create()->id_provinsi,
            'pengguna_sarana_id_pengguna_sarana' => \App\Models\PenggunaSarana::factory()->create()->id_pengguna_sarana,
        ];
    }
}
