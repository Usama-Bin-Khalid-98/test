<?php

namespace App\Models;

use App\Models\Common\Department;
use App\Models\Common\Campus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeskReview extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }


    public function department() {
        return $this->belongsTo(Department::class);
    }

}
