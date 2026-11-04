<?php

namespace Database\Factories;

use App\Models\Perangkat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Perangkat>
 */
class PerangkatFactory extends Factory
{
    protected $model = Perangkat::class;

    public function definition(): array
    {
        // [nama perangkat, daya dalam watt]
        [$nama, $daya] = fake()->randomElement([
            ['AC 1 PK', 900],
            ['Kulkas 2 Pintu', 150],
            ['TV LED 43"', 100],
            ['Mesin Cuci', 350],
            ['Kipas Angin', 50],
            ['Lampu LED', 12],
            ['Rice Cooker', 400],
            ['Laptop', 65],
            ['Dispenser', 350],
            ['Setrika', 350],
            ['Pompa Air', 250],
            ['Router WiFi', 10],
        ]);

        return [
            // Jika email tidak diberikan, otomatis dibuatkan user baru
            'email'            => User::factory(),
            'nama_perangkat'   => $nama,
            'daya'             => $daya,
            'tarif_listrik'    => 1444,
            'waktu_penggunaan' => fake()->randomElement([1, 2, 4, 6, 8, 12, 24]),
            // kWh per hari = daya x jam / 1000, ikut menyesuaikan jika daya/jam diubah
            'kwh'              => fn (array $atribut) => round(
                $atribut['daya'] * $atribut['waktu_penggunaan'] / 1000,
                2
            ),
        ];
    }
}