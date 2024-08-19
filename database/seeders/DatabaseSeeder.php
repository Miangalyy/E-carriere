<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Corps;
use App\Models\Direction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
     //   $this->call(DirectionSeeder::class);
      //  $this->call(CorpsSeeder::class);
      //  $this->call(ExperienceSeeder::class);
      //  $this->call(FormationSeeder::class);
      // $this->call(GradeSeeder::class);
      //  \App\Models\Service::factory(10)->create();
     \App\Models\Fonction::factory(10)->create();
      \App\Models\User::factory(10)->create();
       //  \App\Models\Corps::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',tfgklw2ojfdnm0nfdmn9rfwrrrrrrrq                                                                                                                                                                                                                                                                                                             yrnffffffffffffffffffnrf9 rrrruhuzn
        //     'email' => 'test@example.com',
        // ]);
    }
}