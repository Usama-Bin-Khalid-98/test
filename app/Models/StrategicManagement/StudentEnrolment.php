<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Common\Program;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentEnrolment extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function program() {
        return $this->belongsTo(Program::class)->withTrashed();
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}
