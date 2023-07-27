<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatejobRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'job_name'=>'required',
            'job_active'=>'required'
        ];
    }
    public function messages()
    {
     return [
        'job_name.required'=>'the name of job is required',
        'job_active.required'=>'the active status of job is required'
     ];   
    }
}
