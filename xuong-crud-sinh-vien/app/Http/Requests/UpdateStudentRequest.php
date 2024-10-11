<?php

namespace App\Http\Requests;

use App\Models\Classroom;
use App\Models\Passport;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $idStudent = $this->route('student')->id;
        $idPassport = $this->route('student')->passport->id;

        return [
            'student.name'              =>  ['required'],
            'student.email'             =>  ['required', 'email', Rule::unique(Student::class, 'email')->ignore($idStudent)],
            'student.classroom_id'      =>  ['required', Rule::exists(Classroom::class, 'id')],
            'subjects'                  =>  ['required', 'array'],
            'subjects.*'                =>  [Rule::exists(Subject::class, 'id')],
            'passport.passport_number'  =>  ['required', Rule::unique(Passport::class, 'passport_number')->ignore($idPassport)],
            'passport.issued_date'      =>  ['required', 'date', 'before_or_equal:today'],
            'passport.expiry_date'      =>  ['required', 'date', 'after:passport.issued_date'],
        ];
    }
}
