<?php

namespace App\Models\Facility;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facility\Facility;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacilityType extends Model
{
	use SoftDeletes;
    
    protected $guarded = [];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
