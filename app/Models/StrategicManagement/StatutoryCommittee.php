<?php

namespace App\Models\StrategicManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Common\Designation;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatutoryCommittee extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];

  public function designation() {
      return $this->belongsTo(Designation::class);
  }

   public function statutory_body() {
       return $this->belongsTo(StatutoryBody::class);
   }
}
