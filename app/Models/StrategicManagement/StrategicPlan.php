<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\StrategicManagement\StrategicPlan;
use App\User;
use App\Models\Common\Campus;
use Illuminate\Database\Eloquent\SoftDeletes;

class StrategicPlan extends Model
{
     use SoftDeletes;
    
    protected $guarded = [];

 public function user() {
       return $this->belongsTo(User::class);
   }
}
