<?php

namespace App\Models\Facility;
use Illuminate\Database\Eloquent\Model;
use App\Models\Facility\FacilityType;
use App\Models\Facility\Facility;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessSchoolFacility extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function facility_types()
    {
        return $this->belongsTo(FacilityType::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    
}
