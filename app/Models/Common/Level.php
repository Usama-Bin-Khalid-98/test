<?php

namespace App\Models\Common;

use App\Models\StrategicManagement\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Level extends Model
{
    use SoftDeletes;
    //
    protected $guarded = [];

    public function scope() {
        return $this->hasOne(Scope::class);
    }
}
