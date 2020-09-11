<?php

namespace App\Models\Common;

use App\BusinessSchool;
use App\Models\EligibilityScreening\EligibilityScreening;
use App\Models\EligibilityScreening\ESReviewer;
use App\Models\EligibilityScreening\ReviewerAvailability;
use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
    //
    protected $guarded = [];

    public function business_school()
    {
        return $this->belongsTo(BusinessSchool::class)->with('user', 'campus');
    }

    public function department()
    {
        return $this->belongsTo(Department::class)->with('department_fee');
    }

    public function eligibility_screening()
    {
        return $this->hasOne(EligibilityScreening::class);
    }

    public function e_s_reviewer()
    {
        return $this->hasOne(ESReviewer::class);
    }
    public function reviewer_availability() {
        return $this->hasOne(ReviewerAvailability::class);
    }
}
