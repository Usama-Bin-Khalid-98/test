<?php

namespace App\Models;

use App\Models\Common\Slip;
use Illuminate\Database\Eloquent\Model;

class MentoringMeeting extends Model
{
    //
    protected $guarded = [];

    public function slip()
    {
        return $this->belongsTo(Slip::class);
    }
}
