<?php

namespace Database\Seeders;

use App\Models\Corps;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CorpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Corps::create(['numero_corps' => 'corps numero 32', 'titre' => 'titre numero 1', 'description' => 'description numero 1']);
        Corps::create(['numero_corps' => 'corps numero 31', 'titre' => 'titre numero 2', 'description' => 'description numero 2']);
        Corps::create(['numero_corps' => 'corps numero 33', 'titre' => 'titre numero 3', 'description' => 'description numero 3']);
        Corps::create(['numero_corps' => 'corps numero 34', 'titre' => 'titre numero 4', 'description' => 'description numero 4']);
        Corps::create(['numero_corps' => 'corps numero 35', 'titre' => 'titre numero 5', 'description' => 'description numero 5']);
    }
}