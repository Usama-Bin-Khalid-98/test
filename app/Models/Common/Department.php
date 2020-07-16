<?php

namespace App\Models\Common;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
