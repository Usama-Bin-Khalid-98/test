<?php

namespace App\Models\Research;

use App\Models\Common\Campus;
use App\PublicationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResearchSummary extends Model
{
    use SoftDeletes;
    //
    protected $guarded = [];

    public function publication_type()
    {
        return $this->belongsTo(PublicationType::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}
