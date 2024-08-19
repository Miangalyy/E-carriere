<?php

namespace Database\Seeders;

use App\Models\Formation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Formation::create(['nom_formation' => 'formation numero 1', 'organisme_formation' => 'organisme numero 1', 'description' => 'description numero 1']);
        Formation::create(['nom_formation' => 'formation numero 2', 'organisme_formation' => 'organisme numero 6', 'description' => 'description numero 2']);
        Formation::create(['nom_formation' => 'formation numero 1', 'organisme_formation' => 'organisme numero 3', 'description' => 'description numero 3']);
        Formation::create(['nom_formation' => 'formation numero 3', 'organisme_formation' => 'organisme numero 1', 'description' => 'description numero 4']);
        Formation::create(['nom_formation' => 'formation numero 1', 'organisme_formation' => 'organisme numero 4', 'description' => 'description numero 5']);
        Formation::create(['nom_formation' => 'formation numero 4', 'organisme_formation' => 'organisme numero 5', 'description' => 'description numero 6']);
        Formation::create(['nom_formation' => 'formation numero 1', 'organisme_formation' => 'organisme numero 1', 'description' => 'description numero 7']);
    }
}