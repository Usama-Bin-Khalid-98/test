<?php

namespace App\Models\PeerReview;

use App\Models\Common\Slip;
use App\User;
use Illuminate\Database\Eloquent\Model;

class PeerReviewReviewer extends Model
{
    //
    protected $guarded = [];

    public function slip()
    {
        return $this->belongsTo(Slip::class)->with('campus');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->with('designation');
    }

}
