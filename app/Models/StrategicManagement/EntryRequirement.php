<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Common\Program;
use App\Models\Common\EligibilityCriteria;
use Illuminate\Database\Eloquent\SoftDeletes;


class EntryRequirement extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function program() {
        return $this->belongsTo(Program::class)->withTrashed();
    }

    public function eligibility_criteria()
    {
        return $this->belongsTo(EligibilityCriteria::class);
    }
}
