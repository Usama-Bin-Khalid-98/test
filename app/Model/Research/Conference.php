<?php

namespace App\Model\Research;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conference extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }
}
