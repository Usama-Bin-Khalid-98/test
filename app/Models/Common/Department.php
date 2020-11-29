<?php

namespace App\Models\Common;

use App\DepartmentFee;
use App\Models\Faculty\FacultyTeachingCources;
use App\Models\MentoringInvoice;
use App\Models\Sar\SarInvoice;
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
    public function mentoring_invoice()
    {
        return $this->hasOne(MentoringInvoice::class);
    }
    public function faculty_teaching_cources() {
        return $this->hasOne(FacultyTeachingCources::class);
    }

    public function sar_invoice()
    {
        return $this->hasOne(SarInvoice::class);
    }

}
