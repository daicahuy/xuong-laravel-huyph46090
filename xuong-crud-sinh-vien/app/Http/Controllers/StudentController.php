<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\Passport;
use App\Models\Subject;
use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->query('keyword') ?? NULL;

        $students = Student::with(['passport', 'classroom', 'subjects'])
            ->latest('id')
            ->when($keyword, function (Builder $query, $keyword) {

                $query->where('name', 'like', "%{$keyword}%")
                ->orWhereHas('classroom', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                });
                
            })
            ->paginate(10)
            ->withQueryString();


        return view('students.index', compact('students', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        //
        $data = $request->validated();


        try {

            DB::transaction(function () use ($data) {
                
                /**
                 * @var Student $student
                 */
                $student = Student::query()->create($data['student']);

                Passport::query()->create($data['passport'] + ['student_id' => $student->id]);

                $student->subjects()->attach($data['subjects']);

            });

        }
        catch (\Throwable $e) {

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $e->getMessage()]
            );

            return back()->with('message', [
                'type' => 'danger',
                'content' => 'Loi server'
            ])->withInput();

        }

        return redirect()->route('students.index')->with('message', [
            'type' => 'success',
            'content' => 'Create new student successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student = Student::with(['passport', 'classroom', 'subjects'])->find($student->id);

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $student = Student::with(['passport', 'classroom', 'subjects'])->find($student->id);

        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
        $data = $request->validated();

        try {

            DB::transaction(function () use ($data, $student) {

                $student->update($data['student']);

                $student->passport()->update($data['passport']);

                $student->subjects()->sync($data['subjects']);

            });

        }
        catch (\Throwable $e) {

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $e->getMessage()]
            );

            return back()->with('message', [
                'type' => 'error',
                'content' => 'Loi server' 
            ]);

        }

        return back()->with('message', [
            'type' => 'success',
            'content' => 'Update student successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
        try {

            DB::transaction(function () use ($student) {

                $student->passport()->delete();

                $student->subjects()->detach();

                $student->delete();

            });

        }
        catch (\Throwable $e) {

            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $e->getMessage()]
            );

            return back()->with('message', [
                'type' => 'danger',
                'content' => 'Loi server'
            ]);

        }

        return back()->with('message', [
            'type' => 'success',
            'content' => 'Delete student successfully'
        ]);
    }
}
