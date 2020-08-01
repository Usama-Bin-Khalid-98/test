<?php

namespace App;

use App\Models\Common\Campus;
use App\Models\Common\Slip;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessSchool extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function slip()
    {
        return $this->hasMany(Slip::class);
    }
    public function campus()
    {
        return $this->hasOne(Campus::class);
    }
}
