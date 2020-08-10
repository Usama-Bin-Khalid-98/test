<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Program;
use App\Models\Common\EligibilityCriteria;
use Illuminate\Database\Eloquent\SoftDeletes;


class EntryRequirement extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function eligibility_criteria()
    {
        return $this->belongsTo(EligibilityCriteria::class);
    }
}
