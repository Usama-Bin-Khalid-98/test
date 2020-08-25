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
        return $this->belongsTo(BusinessSchool::class)->with('user', 'campus');
    }

    public function department()
    {
        return $this->belongsTo(Department::class)->with('department_fee');
    }
}
