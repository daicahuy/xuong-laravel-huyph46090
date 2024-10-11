<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $names = ['Tiếng Anh', 'PHP3', 'PHP2', 'PHP1', 'Frontend Framework 1', 'Frontend Framework 2'];
        $credits = [1, 3, 5];

        $students = DB::table('students')->pluck('id')->all();

        for ($i = 0; $i < count($names); $i++) {
            DB::table('subjects')->insert([
                'name' => $names[$i],
                'credits' => fake()->randomElement($credits),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
