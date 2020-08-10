<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Common\Campus;

class BudgetaryInfo extends Model
{
     use SoftDeletes;
    
    protected $guarded = [];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}
