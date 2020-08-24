<?php

namespace App\Models\Faculty;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Common\Designation;
use App\Models\Common\CourseType;
use App\Models\Common\Degree;
use App\LookupFacultyType;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyDetailedInfo extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }

    public function lookup_faculty_type() {
        return $this->belongsTo(LookupFacultyType::class);
    }

    public function course_type() {
        return $this->belongsTo(CourseType::class);
    }

    public function degree() {
        return $this->belongsTo(Degree::class);
    }

}
