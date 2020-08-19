<?php

namespace App\Models\External_Linkages;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Common\Designation;
use App\Models\StrategicManagement\StatutoryBody;
use Illuminate\Database\Eloquent\SoftDeletes;

class BodyMeeting extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }

    public function statutory_bodies() {
        return $this->belongsTo(StatutoryBody::class);
    }
}
