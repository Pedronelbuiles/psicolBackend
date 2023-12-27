<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Professor;
use App\Models\Signature;
use App\Models\Student;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Student::factory()->times(20)->create();
        Professor::factory()->times(5)->create();
        Signature::factory()->times(10)->create()->each(function($signature)
        {
            $signature->students()->sync(
                Student::all()->random(5)
            );
            $signature->professors()->sync(
                Professor::all()->random(2)
            );
        });

    }
}
