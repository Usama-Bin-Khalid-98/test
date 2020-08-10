<?php

namespace App\Models\Common;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    use SoftDeletes;
    
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

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
