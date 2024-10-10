<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idProject)
    {
        /**
         * @var Project $project
         */
        $project = Project::query()->find($idProject);

        if (!$project) {
            return response()->json([
                'message' => 'Không tìm thấy project có id là ' . $idProject
            ], 404);
        }

        $tasks = $project->tasks()->select(['id', 'task_name', 'description', 'status'])->get();

        return response()->json([
           'tasks' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, $idProject)
    {
        $project = Project::query()->find($idProject);

        if (!$project) {
            return response()->json([
                'message' => 'Không tìm thấy project có id là ' . $idProject
            ]);
        }

        $data = $request->validated();

        $data['project_id'] = $project->id;

        try {

            $taskNew = Task::query()->create($data);

        }
        catch (\Exception $e) {
            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $e->getMessage()]
            );

            return response()->json([
               'message' => 'System Error'
            ], 500);
        }

        return response()->json([
            'message' => 'Nhiệm vụ được tạo',
            'task' => $taskNew
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::query()->find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Không tìm thấy task có id là ' . $id
            ], 404);
        }

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = Task::query()->find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Không tìm thấy bản ghi có id là ' . $id
            ], 404);
        }

        $data = $request->validated();

        try {

            $task->update($data);

        }
        catch (\Exception $e) {
            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $e->getMessage()]
            );

            return response()->json([
                'message' => 'System Error'
            ], 500);
        }

        return response()->json([
            'message' => 'Nhiệm vụ được cập nhật',
            'task' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::query()->find($id);

        if ($task) {

            $task->delete();

            return response()->json(['Nhiệm vụ đã được xóa'], 204);

        }

        return response()->json([
            'message' => 'Không tìm thấy task có id là ' . $id
        ], 404);
    }
}
