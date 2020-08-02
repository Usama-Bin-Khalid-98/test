<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EligibilityCriteria extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
}
