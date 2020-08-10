<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FypRequirement extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
}
