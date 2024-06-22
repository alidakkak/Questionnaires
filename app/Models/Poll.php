<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function answer()
    {
        return $this->hasMany(answer::class);
    }

    public function option()
    {
        return $this->hasMany(Option::class);
    }
}
