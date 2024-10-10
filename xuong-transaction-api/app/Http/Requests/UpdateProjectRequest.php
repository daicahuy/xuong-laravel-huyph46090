<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
        $id = $this->route('project');

        return [
            'project_name' => ['required', 'max:255', Rule::unique('projects')->ignore($id)],
            'description' => ['nullable', 'max:255'],
            'start_date' => ['required', 'date_format:Y-m-d'],
        ];
    }
    
}
