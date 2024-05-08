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
            'mitra_id_mitra' => \App\Models\Mitra::factory()->create()->id_mitra,
        ];
    }
}
