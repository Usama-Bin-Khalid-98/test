<?php

namespace App\Models\External_Linkages;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlacementOffice extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }
}
