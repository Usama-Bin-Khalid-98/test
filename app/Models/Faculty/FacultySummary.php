<?php

namespace App\Models\Faculty;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Common\Campus;
use App\Models\Common\FacultyQualification;
use App\Models\Common\Discipline;


class FacultySummary extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function faculty_qualification() {
        return $this->belongsTo(FacultyQualification::class);
    }

    public function discipline() {
        return $this->belongsTo(Discipline::class);
    }
}
