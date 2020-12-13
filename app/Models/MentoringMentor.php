<?php

namespace App\Models;

use App\Models\Common\Slip;
use App\User;
use Illuminate\Database\Eloquent\Model;

class MentoringMentor extends Model
{
    //
    protected $guarded = [];

    public function slip()
    {
        return $this->belongsTo(Slip::class)->with('campus', 'department');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
