<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kategori;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PerhitunganSampah>
 */
class PerhitunganSampahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'tanggal' => $this->faker->date(),
            'jumlah_sampah' => $this->faker->randomNumber(4),
            'sarana_id_sarana' => function () {
                return \App\Models\Sarana::factory()->create()->id_sarana;
            },
            'kategori_id_kategori' => function () {
                return Kategori::factory()->create()->id_kategori;
            },
            'user_id_user' => function () {
                return \App\Models\User::factory()->create()->id;
            },

        ];
    }
}
