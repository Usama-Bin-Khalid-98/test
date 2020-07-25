<?php

namespace App\Models\Common;

use App\BusinessSchool;
use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
    //
    protected $guarded = [];

    public function business_school()
    {
        return $this->belongsTo(BusinessSchool::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
