<?php

namespace App;

use App\Models\Common\Slip;
use Illuminate\Database\Eloquent\Model;

class BusinessSchool extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function slip()
    {
        return $this->hasMany(Slip::class);
    }
}
