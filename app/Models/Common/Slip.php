<?php

namespace App\Models\Common;

use App\BusinessSchool;
use App\Mentoring\ScheduleMentorMeeting;
use App\Models\AccreditationAC\AccreditationMeeting;
use App\Models\AccreditationAC\AccreditationReviewer;
use App\Models\EligibilityScreening\EligibilityScreening;
use App\Models\EligibilityScreening\ESReviewer;
use App\Models\EligibilityScreening\ReviewerAvailability;
use App\Models\MentoringMeeting;
use App\Models\MentoringMentor;
use App\Models\PeerReview\PeerReviewReport;
use App\Models\PeerReview\SchedulePeerReview;
use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
    //
    protected $guarded = [];

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'business_school_id', 'id')->with('user', 'business_school');
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

    public function mentoring_mentor()
    {
        return $this->hasOne(MentoringMentor::class);
    }

    public function mentoring_meeting()
    {
        return $this->hasOne(MentoringMeeting::class);
    }

    public  function schedule_mentor_meeting()
    {
        return $this->hasOne(ScheduleMentorMeeting::class);
    }

    public function schedule_peer_review()
    {
        return $this->hasOne(SchedulePeerReview::class);
    }

    public function peer_review_report()
    {
        return $this->hasOne(PeerReviewReport::class);
    }

    public function accreditation_award_committee()
    {
        return $this->hasOne(AccreditationMeeting::class);
    }

    public function accreditation_reviewer()
    {
        return $this->hasOne(AccreditationReviewer::class);
    }
}
