<?php

namespace App;

use App\Models\Common\PublicationCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicationType extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function publication_category()
    {
        return $this->belongsTo(PublicationCategory::class);
    }
}
