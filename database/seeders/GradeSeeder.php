<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grade::create(['numero_grade' => 'grade numero 32', 'titre' => 'titre numero 1', 'description' => 'description numero 1']);
        Grade::create(['numero_grade' => 'grade numero 34', 'titre' => 'titre numero 1', 'description' => 'description numero 1']);
        Grade::create(['numero_grade' => 'grade numero 82', 'titre' => 'titre numero 1', 'description' => 'description numero 1']);
        Grade::create(['numero_grade' => 'grade numero 14', 'titre' => 'titre numero 1', 'description' => 'description numero 1']);
        Grade::create(['numero_grade' => 'grade numero 54', 'titre' => 'titre numero 1', 'description' => 'description numero 1']);
        Grade::create(['numero_grade' => 'grade numero 16', 'titre' => 'titre numero 1', 'description' => 'description numero 1']);
        Grade::create(['numero_grade' => 'grade numero 17', 'titre' => 'titre numero 1', 'description' => 'description numero 1']);
        Grade::create(['numero_grade' => 'grade numero 18', 'titre' => 'titre numero 1', 'description' => 'description numero 1']);
    }
}