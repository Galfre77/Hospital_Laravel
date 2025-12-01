<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\paciente>
 */
class pacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nif' => $this->faker->unique()->numerify('#########'),
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'fechaingreso' => $this->faker->date(),
            'fechaalta' => $this->faker->date(),
        ];
    }
}
