<?php

namespace App\Models\Faculty;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Common\Program;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyStudentRatio extends Model
{
    use SoftDeletes;
    protected $table = 'faculty_student_ratio';

    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function program() {
        return $this->belongsTo(Program::class)->withTrashed();
    }
}
