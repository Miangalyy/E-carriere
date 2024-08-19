<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "numero_service" =>rand(1, 100),
            "titre" => ["Titre 1", "Titre 2", "Titre 3"][rand(0, 2)],
            "description" => ["description numero 1", "Description numero 2", "Description numero 3"][rand(0, 2)],
            "direction_id" => rand(1, 7),
            "responsable" => ["responsable 1", "responsable 2", "responsable 3"][rand(0, 2)]
        ];
    }
}