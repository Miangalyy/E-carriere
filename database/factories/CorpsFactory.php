<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Corps>
 */
class CorpsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "numero_corps" =>rand(1, 100),
            "titre" => ["Titre 1", "Titre 2", "Titre 3"][rand(0, 2)],
            "description" => ["description numero 1", "Description numero 2", "Description numero 3"][rand(0, 2)],
            "grade_id" => rand(1, 7)
            
        ];
    }
}