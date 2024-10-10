<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        $projects = Project::all();
//
//        foreach ($projects as $project) {
//            Task::query()->create([
//                'project_id' => $project->id,
//                'task_name' => fake()->name,
//                'description' => fake()->text(),
//                'status' => fake()->randomElement(['Chưa bắt đầu', 'Đang thực hiện', 'Hoàn thành']),
//            ]);
//        }


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
