<?php

namespace App\Models\Faculty;

use Illuminate\Database\Eloquent\Model;
use App\BusinessSchool;
use App\Models\Common\Program;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyStudentRatio extends Model
{
    use SoftDeletes;
    protected $table = 'faculty_student_ratio';

    protected $guarded = [];

    public function business_school() {
        return $this->belongsTo(BusinessSchool::class);
    }

    public function program() {
        return $this->belongsTo(Program::class);
    }
}
