<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professor>
 */
class ProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document' => $this->faker->randomNumber(5, true),
            'name' => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->randomNumber(5, true),
            'email' => preg_replace('/@example\..*/', '@psicol.com', $this->faker->unique()->safeEmail),
            'adress' => $this->faker->name(),
            'city' => $this->faker->name()
        ];
    }
}
