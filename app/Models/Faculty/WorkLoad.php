<?php

namespace App\Models\Faculty;

use Illuminate\Database\Eloquent\Model;
use App\BusinessSchool;
use App\LookupFacultyDesignation;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkLoad extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function business_school() {
        return $this->belongsTo(BusinessSchool::class);
    }

    public function lookup_faculty_designation() {
        return $this->belongsTo(LookupFacultyDesignation::class);
    }

}
