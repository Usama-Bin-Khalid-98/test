<?php

namespace App\Models\Facility;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facility\FacilityType;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
	use SoftDeletes;
    
    protected $guarded = [];
    
    public function facility_type()
    {
        return $this->belongsTo(FacilityType::class);
    }
}
