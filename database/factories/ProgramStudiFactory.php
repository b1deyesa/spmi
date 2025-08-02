<?php

namespace Database\Factories;

use App\Models\ProgramStudi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProgramStudi>
 */
class ProgramStudiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fakultas_id' => rand(1, 10),
            'jenjang_id' => rand(1, 8),
            'nama' => fake()->sentence(3),
            'tanggal_didirikan' => '2022-05-19'
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (ProgramStudi $program_studi) {
            $program_studi->akreditasis()->attach(rand(1, 6), [
                'tanggal_berlaku' => fake()->randomElement(['2023-01-01', '2024-01-01', '2025-01-01']),
                'tanggal_berakhir' => '2030-05-19',
                'nomor_sk' => fake()->randomNumber(5, true),
                'is_internasional' => fake()->boolean(),
            ]);
        });
    }
}
