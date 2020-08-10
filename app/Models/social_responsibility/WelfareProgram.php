<?php

namespace App\Models\social_responsibility;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WelfareProgram extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
}
