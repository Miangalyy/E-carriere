<?php

namespace Database\Seeders;

use App\Models\Direction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        Direction::create(['numero_direction' => '24D86', 'titre' => 'titre numero 1', 'description' => 'description numero 1', 'responsable' =>'responsable']);
        Direction::create(['numero_direction' => '26G57', 'titre' => 'titre numero 2', 'description' => 'description numero 2', 'responsable' =>'responsable']);
        Direction::create(['numero_direction' => '27D34', 'titre' => 'titre numero 2', 'description' => 'description numero 2', 'responsable' =>'responsable']);
        Direction::create(['numero_direction' => '235J6', 'titre' => 'titre numero 3', 'description' => 'description numero 3', 'responsable' =>'responsable']);
        Direction::create(['numero_direction' => '22P59', 'titre' => 'titre numero 4', 'description' => 'description numero 4', 'responsable' =>'responsable']);
        Direction::create(['numero_direction' => '29P59', 'titre' => 'titre numero 4', 'description' => 'description numero 4', 'responsable' =>'responsable']);
        Direction::create(['numero_direction' => '23P54', 'titre' => 'titre numero 4', 'description' => 'description numero 4', 'responsable' =>'responsable']);
        Direction::create(['numero_direction' => '23H54', 'titre' => 'titre numero 4', 'description' => 'description numero 4', 'responsable' =>'responsable']);
    }
}