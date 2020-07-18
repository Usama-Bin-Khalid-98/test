<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\StrategicManagement\StrategicPlan;
use Illuminate\Database\Eloquent\SoftDeletes;

class StrategicPlan extends Model
{
     use SoftDeletes;
    
    protected $guarded = [];

 
}
