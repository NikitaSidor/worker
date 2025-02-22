<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        return [
            'department.id'=> [
                'nullable',
                'exists:department.id',
            ],
            'department.name' => 'required',
            'department.parent_department_id' => [
                'nullable',
                'required'
            ],
            'department.manager_id' => [
                'nullable',
                'required'
            ]
        ];
    }
}
