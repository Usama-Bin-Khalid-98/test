<?php

namespace App\Models\Faculty;

use App\Models\Common\Department;
use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Common\Designation;
use App\LookupFacultyType;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyTeachingCources extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function lookup_faculty_type() {
        return $this->belongsTo(LookupFacultyType::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }
    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function faculty_program()
    {
        return $this->hasMany(FacultyProgram::class, 'faculty_teaching_cource_id', 'id')->with('program');
    }

}
