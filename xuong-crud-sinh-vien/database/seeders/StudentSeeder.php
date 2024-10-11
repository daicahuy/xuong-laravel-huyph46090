<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $classrooms = Classroom::query()->pluck('id')->all();
        $students = [];
        for ($i = 0; $i <= 100; $i++) {
            $students[] = [
                'name' => fake()->name(),
                'email' => fake()->unique()->email(),
                'classroom_id' => fake()->randomElement($classrooms),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if ($i % 50 == 0) {
                DB::table('students')->insert($students);
                $students = [];
            }

        }
    }
}
