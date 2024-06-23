<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubmissionAnswer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function selectedAnswer()
    {
        return $this->belongsTo(Answer::class, 'selected_answer_id');
    }
}
