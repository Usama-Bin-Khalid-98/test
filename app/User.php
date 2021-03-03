<?php

namespace App;

use App\Mentoring\ScheduleMentorMeeting;
use App\Models\AccreditationAC\AccreditationReviewer;
use App\Models\Common\Campus;
use App\Models\Common\Department;
use App\Models\Common\Designation;
use App\Models\EligibilityScreening\ReviewerAvailability;
use App\Models\MentoringInvoice;
use App\Models\MentoringMentor;
use App\Models\PeerReview\SchedulePeerReview;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    use SoftDeletes;
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function business_school()
    {
        return $this->belongsTo(BusinessSchool::class)->with('slip')->with('campus');
    }
    public function reviewer_availability() {
        return $this->hasOne(ReviewerAvailability::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function mentoring_mentor()
    {
        return $this->hasMany(MentoringMentor::class);
    }

    public function schedule_mentor_meeting()
    {
        return $this->hasOne(ScheduleMentorMeeting::class);
    }

    public function mentoring_invoice()
    {
        return $this->hasOne(MentoringInvoice::class, 'id', 'created_by');
    }

    public function schedule_peer_review()
    {
        return $this->hasOne(SchedulePeerReview::class);
    }

    public function accreditation_reviewer()
    {
        return $this->hasOne(AccreditationReviewer::class);
    }

}

