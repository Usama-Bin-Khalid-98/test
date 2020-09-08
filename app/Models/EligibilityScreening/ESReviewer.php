<?php

namespace App\Models\EligibilityScreening;

use App\Models\Common\Slip;
use Illuminate\Database\Eloquent\Model;

class ESReviewer extends Model
{
    //
    protected $guarded = [];

    public function slip()
    {
        return $this->belongsTo(Slip::class);
    }
}
