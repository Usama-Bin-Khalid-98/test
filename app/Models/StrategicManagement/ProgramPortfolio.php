<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\StrategicManagement\ProgramPortfolio;
use App\Models\Common\Program;
use App\Models\Common\CourseType;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramPortfolio extends Model
{
     use SoftDeletes;
    
    protected $guarded = [];

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function course_type()
    {
        return $this->belongsTo(CourseType::class);
    }
}
