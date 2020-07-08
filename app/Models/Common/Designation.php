<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    //
    protected $guarded =[];

    public function contact_info()
    {
        return $this->hasOne(ContactInfo::class);
    }

    public function statutory_body() {
        return $this->hasOne(StatutoryCommittee::class);
    }

    public function statutory_committee()
    {
        return $this->hasOne(StatutoryCommittee::class);
    }
}
