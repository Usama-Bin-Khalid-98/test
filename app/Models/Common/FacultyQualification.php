<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class FacultyQualification extends Model
{
    //
=======
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyQualification extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
>>>>>>> fb5ba0be3d2c2c24a2617060c6f106a0c26b7269
}
