<?php

namespace App\Models\PeerReview;

use App\Models\Common\Slip;
use Illuminate\Database\Eloquent\Model;

class PeerReviewReport extends Model
{
    //
    protected $guarded = [];

    public function slip()
    {
        return $this->belongsTo(Slip::class)->with('business_school');
    }

}
