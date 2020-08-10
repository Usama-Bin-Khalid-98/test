<?php

namespace App\Models\facility;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialRisk extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}
