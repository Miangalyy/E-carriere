<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Experience::create(['fonction' => 'fonction numero 1', 'description' => 'description numero 1']);
        Experience::create(['fonction' => 'fonction numero 2', 'description' => 'description numero 2']);
        Experience::create([ 'fonction' => 'fonction numero 3', 'description' => 'description numero 3']);
        Experience::create([ 'fonction' => 'fonction numero 1', 'description' => 'description numero 1']);
        Experience::create(['fonction' => 'fonction numero 1', 'description' => 'description numero 1']);
        Experience::create(['fonction' => 'fonction numero 4', 'description' => 'description numero 4']);
        Experience::create([ 'fonction' => 'fonction numero 1', 'description' => 'description numero 1']);
        Experience::create([ 'fonction' => 'fonction numero 1', 'description' => 'description numero 1']);
    }
}