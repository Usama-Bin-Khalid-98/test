<?php

namespace App\Models\Common;

use App\User;
use App\Models\StrategicManagement\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;
    //
    protected $guarded = [];

    public function scope() {
        return $this->hasOne(Scope::class);
    }
    public function slip()
    {
        return $this->hasOne(Slip::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
