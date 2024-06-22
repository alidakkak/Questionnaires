<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function poll()
    {
        return $this->belongsTo(poll::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}