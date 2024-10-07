<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {

            $employees = Employee::query()->latest('id')->paginate(5);

        } catch (\Throwable $e) {
            Log::debug($e);
            echo "LOI ROI";
        }

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            "first_name"       =>  ['required', 'max:100'],
            "last_name"        =>  ['required', 'max:100'],
            "email"            =>  [
                'required',
                'email',
                Rule::unique(Employee::class)
            ],
            "phone"            =>  ['required', 'string', 'max:20'],
            "date_of_birth"    =>  ['required', 'date', 'before:today'],
            "hire_date"        =>  ['required', 'date', 'before:tomorrow'],
            "salary"           =>  ['required', 'numeric', 'max:999999999.99'],
            "is_active"        =>  ['nullable', Rule::in([0, 1])],
            "department_id"    =>  ['required', 'integer'],
            "manager_id"       =>  ['required', 'integer'],
            "address"          =>  ['required'],
            "profile_picture"  =>  ['required', 'image', 'max:2048'],
        ]);

        try {

            $profilePicture = $request->file('profile_picture')->getRealPath();

            $data['profile_picture'] = base64_encode(file_get_contents($profilePicture));

            Employee::query()->create($data);
        } catch (\Throwable $e) {
            Log::debug($e->getMessage());
            return redirect()->back()
                ->with('success', false);
        }

        return redirect()->route('employees.index')
            ->with('success', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
        $data = $request->validate([
            "first_name"       =>  ['required', 'max:100'],
            "last_name"        =>  ['required', 'max:100'],
            "email"            =>  [
                'required',
                'email',
                Rule::unique(Employee::class)->ignore($employee->id)
            ],
            "phone"            =>  ['required', 'string', 'max:20'],
            "date_of_birth"    =>  ['required', 'date', 'before:today'],
            "hire_date"        =>  ['required', 'date', 'before:tomorrow'],
            "salary"           =>  ['required', 'numeric', 'max:999999999.99'],
            "is_active"        =>  ['nullable', Rule::in([0, 1])],
            "department_id"    =>  ['required', 'integer'],
            "manager_id"       =>  ['required', 'integer'],
            "address"          =>  ['required'],
            "profile_picture"  =>  ['image', 'max:2048'],
        ]);

        try {
            
            // x = x + 1 => x = x ?? 1
            $data['is_active'] ??= 0;

            if($request->hasFile('profile_picture')) {
                
                $profilePicture = $request->file('profile_picture')->getRealPath();
    
                $data['profile_picture'] = base64_encode(file_get_contents($profilePicture));

            }

            $employee->update($data);


        } catch (\Throwable $e) {
            Log::debug($e->getMessage());
            return redirect()->back()
                ->with('success', false);
        }

        return back()->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
        try {

            $employee->delete();

        }
        catch (\Throwable $e) {
            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $e->getMessage()]
            );
            return back()->with('success', false);
        }

        return back()->with('success', true);
    }


    // FORCE DELETE
    public function forceDelete(Employee $employee)
    {
        //
        try {

            $employee->forceDelete();

        }
        catch (\Throwable $e) {
            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $e->getMessage()]
            );
            return back()->with('success', false);
        }

        return back()->with('success', true);
    }
}
