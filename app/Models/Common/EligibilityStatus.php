<?php

namespace App\Models\Common;

use App\BusinessSchool;
use Illuminate\Database\Eloquent\Model;

class EligibilityStatus extends Model
{
    //
    protected $guarded = [];

    public function business_school()
    {
        return $this->belongsTo(BusinessSchool::class);
    }
}
