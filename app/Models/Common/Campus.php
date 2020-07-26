<?php

namespace App\Models\Common;

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
}
