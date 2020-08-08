<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyDegree extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
}
