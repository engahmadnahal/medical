<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory,SoftDeletes;
    public function doctors(){
        return $this->hasMany(Doctor::class,'city_id','id');
    }

    public function pateints(){
        return $this->hasMany(Patient::class,'city_id','id');
    }

    public function getCityStatusAttribute()
    {
        return $this->active == 1 ? __('cms.active') : __('cms.in_active');
    }

    protected $casts = [
        'created_at'=>'date:Y-m-d',
        'deleted_at'=>'date:Y-m-d'
    ];

    protected $hidden = [
        "deleted_at",
        "created_at",
        "updated_at",
    ];
}
