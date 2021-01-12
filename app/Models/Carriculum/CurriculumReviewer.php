<?php

namespace App\Models\Carriculum;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CurriculumReviewer extends Model
{
    //
    protected $guarded = [];

    public function curriculum_review(){
        return $this->belongsTo(CurriculumReview::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

