<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    //

    public function designation() {
        return $this->belongsTo(Designation::class);
    }
}
