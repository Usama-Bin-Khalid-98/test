<?php

namespace App\Models\Common;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    use SoftDeletes;
    
    protected $guarded =[];

    public function contact_info()
    {
        return $this->hasOne(ContactInfo::class);
    }

    public function statutory_body() {
        return $this->hasOne(StatutoryCommittee::class);
    }

    public function statutory_committee()
    {
        return $this->hasOne(StatutoryCommittee::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
    
    public function scopeByName($query, $name)
    {
        return $query->whereRaw('LOWER(name) = ?', strtolower($name));
    }

    public static function getOrCreate($id, $name) {
        if($id == 8){
            if(!$name){
                return [-1, response()->json(['error' => 'If Designation is specified as "other",
                designation name must be provided'])];
            }
            $designation = Designation::byName($name)->first();
            if(!$designation){
                $id = Designation::create([
                    'name' => $name,
                    'is_default' => false
                ])->id;
            }else{
                if($designation->is_default){
                    return [-1, response()->json(['error' => 'Designation already exists in list'])];
                }
                $id = $designation->id;
            }
        }
        return [$id, null];
    }
}
