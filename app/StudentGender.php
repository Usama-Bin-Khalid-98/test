<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Program;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentGender extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function program() {
        return $this->belongsTo(Program::class);
    }
}
