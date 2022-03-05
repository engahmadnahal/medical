<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialite extends Model
{
    use HasFactory,SoftDeletes;
    public function doctors(){
        return $this->hasMany(Doctor::class,'specialite_id','id');
    }
    public function getSpecialiteStatusAttribute()
    {
        return $this->active == 1 ? __('cms.active') : __('cms.in_active');
    }

    protected $casts = [
        'created_at'=>'date:Y-m-d',
        'deleted_at'=>'date:Y-m-d'
    ];
}
