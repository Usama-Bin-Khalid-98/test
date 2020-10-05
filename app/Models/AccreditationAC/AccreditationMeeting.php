<?php

namespace App\Models\AccreditationAC;

use App\Models\Common\Slip;
use Illuminate\Database\Eloquent\Model;

class AccreditationMeeting extends Model
{
    //
    protected $guarded = [];

    public function slip()
    {
        return $this->belongsTo(Slip::class);
    }
}
