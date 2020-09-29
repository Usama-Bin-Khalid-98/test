<?php

namespace App\Models\PeerReview;

use App\Models\Common\Slip;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SchedulePeerReview extends Model
{
    //
    protected $guarded = [];

    public function slip()
    {
        return $this->belongsTo(Slip::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
