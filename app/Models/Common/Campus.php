<?php

namespace App\Models\Common;

use App\BusinessSchool;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function business_school()
    {
        return $this->belongsTo(BusinessSchool::class);
    }
    public function department()
    {
        return $this->hasOne(EligibilityStatus::class);
    }

}
