<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'student_name' => 'required|string',
            'course_name' => 'required|string',
            'course_date' => 'required|string',
            'center' => 'required|string',
            'teacher_name' => 'required|string',
            'rating' => 'required|min:1|max:5',
        ];
    }
}
