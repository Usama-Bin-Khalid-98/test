<?php

namespace App\Models\Faculty;

use App\Models\Common\Program;
use Illuminate\Database\Eloquent\Model;

class FacultyProgram extends Model
{
    //
    protected $guarded = [];

    public function faculty_courses()
    {
        return $this->belongsTo(FacultyTeachingCources::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
