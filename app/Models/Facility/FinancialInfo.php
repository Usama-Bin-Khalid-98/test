<?php

namespace App\Models\Facility;

use Illuminate\Database\Eloquent\Model;
use App\BusinessSchool;
use App\Models\Facility\IncomeSource;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialInfo extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function income_source()
    {
        return $this->belongsTo(IncomeSource::class);
    }

    public function business_school()
    {
        return $this->belongsTo(BusinessSchool::class);
    }
}
