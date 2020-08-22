<?php

namespace App\Models\Faculty;

use App\Models\Common\Semester;
use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Common\Designation;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkLoad extends Model
{
//    use SoftDeletes;

    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

}
