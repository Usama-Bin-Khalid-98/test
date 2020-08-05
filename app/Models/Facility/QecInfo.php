<?php

namespace App\Models\facility;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Facility\QecType;
use Illuminate\Database\Eloquent\SoftDeletes;

class QecInfo extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function qec_type()
    {
        return $this->belongsTo(QecType::class);
    }
}
