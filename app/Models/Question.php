<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function polls()
    {
        return $this->belongsToMany(Poll::class, 'poll_question', 'question_id', 'poll_id')->withPivot('mark');;
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
