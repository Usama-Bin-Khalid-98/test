<?php

namespace App\Models\Mentoring;

use App\Models\MentoringInvoice;
use Illuminate\Database\Eloquent\Model;

class MentoringReport extends Model
{
    //
    protected $guarded = [];

    public function mentoring_invoice()
    {
        return $this->belongsTo(MentoringInvoice::class)->with('campus','department');
    }
}
