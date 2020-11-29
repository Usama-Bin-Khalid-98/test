<?php

namespace App\Models\Sar;

use App\Models\Common\Campus;
use App\Models\Common\Department;
use Illuminate\Database\Eloquent\Model;

class SarInvoice extends Model
{
    protected $guarded = [];
    //

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class)->with('business_school', 'user');
    }
}
