<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundingSources extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
}
