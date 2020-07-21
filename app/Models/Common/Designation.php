<?php

namespace App\Models\StrategicManagement;
namespace App\Models\Faculty;

use App\User;
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

    public function work_load()
    {
        return $this->hasOne(WorkLoad::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
