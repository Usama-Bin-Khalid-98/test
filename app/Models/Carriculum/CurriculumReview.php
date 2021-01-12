<?php

namespace App\Models\Carriculum;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use App\Models\Common\Designation;
use App\Models\StrategicManagement\Affiliation;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurriculumReview extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }

    public function affiliations() {
        return $this->belongsTo(Affiliation::class);
    }

    public function curriculum_reviewer()
    {
        return $this->hasMany(CurriculumReviewer::class)->with('user');
    }
}
