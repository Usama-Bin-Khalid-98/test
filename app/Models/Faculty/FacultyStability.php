<?php

namespace App\Models\faculty;

use Illuminate\Database\Eloquent\Model;
use App\BusinessSchool;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyStability extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function business_school() {
        return $this->belongsTo(BusinessSchool::class);
    }

}
