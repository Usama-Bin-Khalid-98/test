<?php

namespace App\Models\Research;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResearchSummary extends Model
{
    use SoftDeletes;
    //
    protected $guarded = [];
}
