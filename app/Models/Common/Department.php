<?php

namespace App\Models\Common;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    //
    use SoftDeletes;

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
