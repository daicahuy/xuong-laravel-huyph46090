<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {

            $projects = Project::query()->select(['id', 'project_name', 'description', 'start_date'])->get();

        }
        catch (\Throwable $e) {
            return response()->json([
                'message' => 'System Error'
            ], 500);
        }

        return response()->json([
            'projects' => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        try {

            $project = Project::query()->create($data);

        }
        catch (\Throwable $e) {

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $e->getMessage()]
            );

            return response()->json([
                'message' => 'System Error'
            ], 500);

        }

        return response([
            'message' => 'Dự án được tạo thành công',
            'project' => $project->only(['id', 'project_name', 'description', 'start_date'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $project = Project::query()->find($id);

        if ($project) {
            return response()->json($project->only(['id', 'project_name', 'description', 'start_date']));
        }

        return response()->json([
            'message' => 'Không tìm thấy project nào có id là ' . $id
        ], 404);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id)
    {
        $project = Project::query()->find($id);

        $data = $request->validated();

        try {

            $project->update($data);

        }
        catch (\Throwable $e) {

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $e->getMessage()]
            );

            return response()->json([
                'message' => 'System Error'
            ], 500);

        }

        return response([
            'message' => 'Dự án được cập nhật thành công',
            'project' => $project->only(['id', 'project_name', 'description', 'start_date'])
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $project = Project::query()->find($id);

        if (!$project) {

            return response()->json([
                'message' => 'Không tìm thấy project nào có id là ' . $id
            ], 404);
        }

        try {

            $project->delete();

        }
        catch (\Throwable $e) {

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $e->getMessage()]
            );

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

        return response()->json([], 204);

    }

}
