<?php

namespace App\Models\Facility;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facility\Facility;

class FacilityType extends Model
{
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
