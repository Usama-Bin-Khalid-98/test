<?php

namespace App\Models\social_responsibility;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\social_responsibility\WelfareProgram;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternalCommunity extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function welfare_program()
    {
        return $this->belongsTo(WelfareProgram::class);
    }
}
