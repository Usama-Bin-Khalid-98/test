<?php

namespace App\Models\Carriculum;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Carriculum\EvaluationItem;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluationMethod extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function evaluation_items() {
        return $this->belongsTo(EvaluationItem::class);
    }
}
