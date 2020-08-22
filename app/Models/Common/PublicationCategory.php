<?php

namespace App\Models\Common;

use App\PublicationType;
use Illuminate\Database\Eloquent\Model;

class PublicationCategory extends Model
{
    //
    protected $guarded = [];

    public function publication_type()
    {
        return $this->hasOne(PublicationType::class);
    }
}
