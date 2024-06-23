<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFormSubmission extends Model
{
    protected $guarded = ['id'];

    public function userSubmissionAnswers()
    {
        return $this->hasMany(UserSubmissionAnswer::class);
    }

    public function getUserSubmissionDetails()
    {
        return $this->userSubmissionAnswers()->with([
            'question' => function ($query) {
                $query->with('answers');
            },
            'selectedAnswer'
        ])->get()->map(function ($userSubmissionAnswer) {
            return [
                'question_id' => $userSubmissionAnswer->question->id,
                'question_title' => $userSubmissionAnswer->question->title,
                'answers' => $userSubmissionAnswer->question->answers->map(function ($answer) {
                    return [
                        'id' => $answer->id,
                        'title' => $answer->title,
                    ];
                }),
                'selected_answer_id' => $userSubmissionAnswer->selected_answer_id,
            ];
        });
    }
}
