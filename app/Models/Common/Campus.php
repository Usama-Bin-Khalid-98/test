<?php

namespace App\Models\Common;

use App\BusinessSchool;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campus extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class)->with('designation');
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
