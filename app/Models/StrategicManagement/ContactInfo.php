<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactInfo extends Model
{
    use SoftDeletes;
    //
    protected $guarded = [];

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
