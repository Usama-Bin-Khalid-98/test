<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatutoryBody extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    //

    public function statutory_body() {
        return $this->belongsTo(StatutoryCommittee::class);
    }
}
