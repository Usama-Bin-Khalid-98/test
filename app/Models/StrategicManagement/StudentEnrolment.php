<?php

namespace App\Models\StrategicManagement;


use App\Models\Common\Program;
use App\Models\Common\UniviersityInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentEnrolment extends Model
{
    use SoftDeletes;
    //
    protected $guarded = [];

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function Uni() {
        return $this->belongsTo(UniviersityInformation::class);
    }
}
