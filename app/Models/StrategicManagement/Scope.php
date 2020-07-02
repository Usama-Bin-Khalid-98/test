<?php

namespace App\Models\StrategicManagement;

use App\Models\Common\Level;
use App\Models\Common\Program;
use Illuminate\Database\Eloquent\Model;

class Scope extends Model
{
    //
    protected $guarded =[];

    public function program() {
        return $this->belongsTo(Program::class);
    }
    public function level() {
        return $this->belongsTo(Level::class);
    }
}
