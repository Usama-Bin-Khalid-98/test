<?php

namespace App\Models;

use App\BusinessSchool;
use App\Models\Common\Campus;
use App\Models\Common\Department;
use App\User;
use Illuminate\Database\Eloquent\Model;

class MentoringInvoice extends Model
{
    //
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function business_school()
    {
        return $this->belongsTo(BusinessSchool::class)->with('user', 'campus');
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class)->with('business_school');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
