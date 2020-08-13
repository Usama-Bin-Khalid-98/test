<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Common\Semester;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassSize extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function semesters() {
        return $this->belongsTo(Semester::class);
    }
}
