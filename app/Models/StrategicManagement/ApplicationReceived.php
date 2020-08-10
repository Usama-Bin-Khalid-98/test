<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Common\Program;
use App\Models\Common\Semester;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationReceived extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
