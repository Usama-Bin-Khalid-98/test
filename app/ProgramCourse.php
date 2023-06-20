<?php

namespace App;

use App\Models\Common\Campus;
use App\Models\Common\CourseType;
use App\Models\Common\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramCourse extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function program() {
        return $this->belongsTo(Program::class)->withTrashed();
    }

    public function course_type()
    {
        return $this->belongsTo(CourseType::class);
    }}
