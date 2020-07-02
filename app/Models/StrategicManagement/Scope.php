<?php

namespace App\Models\StrategicManagement;

use App\Models\Common\Level;
use App\Models\Common\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scope extends Model
{
    use SoftDeletes;
    //
    protected $guarded =[];

    public function program() {
        return $this->belongsTo(Program::class);
    }
    public function level() {
        return $this->belongsTo(Level::class);
    }
}
