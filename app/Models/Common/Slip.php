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

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
