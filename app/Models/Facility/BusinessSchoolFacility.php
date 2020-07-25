<?php

namespace App\Models\Facility;
use Illuminate\Database\Eloquent\Model;
use App\BusinessSchool;
use App\Models\Facility\Facility;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessSchoolFacility extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function business_school()
    {
        return $this->belongsTo(BusinessSchool::class);
    }
}
