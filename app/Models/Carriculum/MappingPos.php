<?php

namespace App\Models\Carriculum;

use App\Models\Common\Program;
use Illuminate\Database\Eloquent\Model;

class MappingPos extends Model
{
    protected $guarded = [];

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function objective() {
        return $this->belongsTo(ProgramObjective::class, 'program_objective_id');
    }

    public function outcome() {
        return $this->belongsTo(LearningOutcome::class, 'learning_outcome_id');
    }
}
