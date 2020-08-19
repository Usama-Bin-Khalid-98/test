<?php

namespace App\Models\Common;

use App\Models\Faculty\WorkLoad;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semester extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function workload()
    {
        return $this->hasOne(WorkLoad::class);
    }
}
