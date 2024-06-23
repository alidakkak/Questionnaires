<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewSubmissionRequest extends FormRequest
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
            'username' => 'required|string',
            'course_name' => 'required|string',
            'course_date' => 'required|string',
            'center' => 'required|string',
            'question_answers' => 'required|array',
            'poll_id' => 'required|numeric|exists:polls,id',
            'total_mark' => 'required|numeric|min:0',
            'question_answers.*.question_id' => 'required|numeric|exists:questions,id',
            'question_answers.*.selected_answer_id' => 'required|numeric|exists:answers,id'
        ];
    }
}
