<?php

namespace App\Models\Common;

use App\BusinessSchool;
use Illuminate\Database\Eloquent\Model;

class EligibilityStatus extends Model
{
    //
    protected $guarded = [];

    public function campus()
    {
        return $this->belongsTo(Campus::class)->with('business_school');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
