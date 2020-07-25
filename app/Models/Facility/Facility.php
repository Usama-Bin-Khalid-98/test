<?php

namespace App\Models\Facility;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facility\FacilityType;

class Facility extends Model
{
    public function facility_type()
    {
        return $this->belongsTo(FacilityType::class);
    }
}
