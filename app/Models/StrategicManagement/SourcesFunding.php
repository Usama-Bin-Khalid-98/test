<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\StrategicManagement\FundingSources;
use Illuminate\Database\Eloquent\SoftDeletes;

class SourcesFunding extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function funding_sources() {
        return $this->belongsTo(FundingSources::class);
    }
}
