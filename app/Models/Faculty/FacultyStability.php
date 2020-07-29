<?php

namespace App\Models\faculty;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Campus;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyStability extends Model
{
    use SoftDeletes;
    protected $table ='faculty_stability';

    protected $guarded = [];

    public function campus() {
        return $this->belongsTo(Campus::class);
    }

}
