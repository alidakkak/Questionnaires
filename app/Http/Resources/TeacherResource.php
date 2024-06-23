<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student_name' => $this->student_name,
            'course_name' => $this->course_name,
            'course_date' => $this->course_date,
            'note' => $this->note,
            'center' => $this->center,
            'teacher_name' => $this->teacher_name,
            'rating' => $this->rating,
            'answers' => json_decode($this->dynamic_question_answers)
        ];
    }
}
