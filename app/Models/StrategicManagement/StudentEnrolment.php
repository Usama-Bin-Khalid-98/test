<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Program;
use App\BusinessSchool;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentEnrolment extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function business_school()
    {
        return $this->belongsTo(BusinessSchool::class);
    }
}
