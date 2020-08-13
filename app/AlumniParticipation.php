<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\ActivityEngagement;
use Illuminate\Database\Eloquent\SoftDeletes;
class AlumniParticipation extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function activity_engagements() {
        return $this->belongsTo(ActivityEngagement::class);
    }
}
