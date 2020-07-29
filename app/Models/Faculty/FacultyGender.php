<?php

namespace App\Models\Faculty;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\LookupFacultyType;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyGender extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function lookup_faculty_type()
    {
        return $this->belongsTo(LookupFacultyType::class);
    }
}
