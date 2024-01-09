<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KeluhanPelanggan>
 */
class KeluhanPelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function randomPhoneNumber() {
        $areaCode = sprintf('%03d', rand(100, 999));
        $prefix = sprintf('%03d', rand(100, 999));
        $lineNumber = sprintf('%04d', rand(1000, 9999));
    
        return '08'.$areaCode.$prefix.$lineNumber;
    }
    public function definition()
    {
        return [
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'nomor_hp' => $this->randomPhoneNumber(),
            'status_keluhan' => fake()->numberBetween(0, 2),
            'keluhan' => $this->faker->text,
        ];
    }
}
