<?php

namespace App\Models\Common;

use App\DepartmentFee;
use App\Models\MentoringInvoice;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function slip()
    {
        return $this->hasOne(Slip::class);
    }

    public function program()
    {
        return $this->hasOne(Program::class);
    }
    public function department_fee()
    {
        return $this->hasOne(DepartmentFee::class);
    }

    public function mentoring_invoice()
    {
        return $this->hasOne(MentoringInvoice::class);
    }
}
