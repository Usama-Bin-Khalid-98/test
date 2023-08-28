<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppendixFile extends Model
{

    protected $guarded = [];
    //
    public function business_school()
    {
        return $this->belongsTo(BusinessSchool::class)->with('slip')->with('campus');
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}
