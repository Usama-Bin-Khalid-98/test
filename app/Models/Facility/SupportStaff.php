<?php

namespace App\Models\facility;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Facility\StaffCategory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportStaff extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function staff_category()
    {
        return $this->belongsTo(StaffCategory::class);
    }
}
