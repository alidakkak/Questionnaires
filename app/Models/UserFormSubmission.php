<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserFormSubmission extends Pivot
{
    protected $guarded = ['id'];
}
