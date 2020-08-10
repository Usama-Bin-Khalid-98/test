<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Common\Program;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentsGraduated extends Model
{
     use SoftDeletes;
    
    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function program() {
        return $this->belongsTo(Program::class);
    }
}
