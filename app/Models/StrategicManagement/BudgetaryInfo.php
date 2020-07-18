<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetaryInfo extends Model
{
     use SoftDeletes;
    
    protected $guarded = [];
}
