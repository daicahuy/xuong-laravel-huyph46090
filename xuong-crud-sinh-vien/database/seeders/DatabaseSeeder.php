<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClassroomSeeder::class,
            StudentSeeder::class,
            PassportSeeder::class,
            SubjectSeeder::class,
        ]);

        $subjects = Subject::query()->pluck('id')->all();
        $students = Student::all();

        foreach ($students as $student) {
            $subjectInStudent = [$subjects[0], $subjects[1], $subjects[2]];
            $student->subjects()->attach($subjectInStudent);
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
