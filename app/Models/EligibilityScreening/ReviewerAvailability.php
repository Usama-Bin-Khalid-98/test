<?php

namespace App\Models\EligibilityScreening;

use App\Models\Common\Slip;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ReviewerAvailability extends Model
{
    //
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function slip() {
        return $this->belongsTo(Slip::class);
    }
}
