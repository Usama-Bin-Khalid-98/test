<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Common\Campus;
use App\Models\Common\Department;
use App\Models\Common\FeeType;

class DepartmentFee extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function fee_type()
    {
        return $this->belongsTo(FeeType::class);
    }
}
