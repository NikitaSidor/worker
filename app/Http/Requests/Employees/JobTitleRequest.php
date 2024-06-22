<?php

namespace App\Http\Requests\Employees;

use Illuminate\Foundation\Http\FormRequest;

class JobTitleRequest extends FormRequest
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
            'job_title.id' => [
                'nullable',
                'exists:job_titles,id',
            ],
            'job_title.name' => 'required',
            'job_title.supervisor' => [
                'nullable',
                'exists:job_titles,id',
            ],
        ];
    }
}
