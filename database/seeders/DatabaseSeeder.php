<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Semester;
use App\Models\Statistic;
use App\Models\Subject;
use App\Models\Year;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Year::factory(5)->create();
        Semester::factory(5)->create();
        Subject::factory(5)->create();
        Exam::factory(5)->create();
        Question::factory(5)->create();
        Answer::factory(5)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
