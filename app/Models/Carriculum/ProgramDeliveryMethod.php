<?php

namespace App\Models\Carriculum;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Carriculum\TeachingMethod;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramDeliveryMethod extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function teaching_methods() {
        return $this->belongsTo(TeachingMethod::class);
    }
}
