<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $teacherName = ['Đức TV', 'Ngọc BQ', 'Hòa NV', 'Đạt LT'];
        for ($i = 0; $i < 5; $i++) {
            DB::table('classrooms')->insert([
                'name' => 'WD1840' . $i,
                'teacher_name' => fake()->randomElement($teacherName),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
