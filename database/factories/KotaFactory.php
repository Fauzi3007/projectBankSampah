<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kota>
 */
class KotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kota' => $this->faker->city('id_ID'),
            'provinsi_id_provinsi' => \App\Models\Provinsi::factory()->create()->id_provinsi,
        ];
    }
}
