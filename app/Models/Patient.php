<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Patient extends Authenticatable
{
    use HasFactory,SoftDeletes,HasRoles,HasApiTokens;

    protected $with = [
        'city'
    ];

        public function doctors(){
        return $this->belongsToMany(Doctor::class,'appointments','patient_id','doctor_id');
    }
    public function appointments(){
        return $this->hasMany(Appointment::class,'patient_id','id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function getAgePateintAttribute()
    {

        $dateNow = explode('-',date('Y-m-d')); // [Y,m,d]
        $ageDoctor = explode('-',$this->birth_date);
        if($dateNow[1] == $ageDoctor[1] && $dateNow[2] == $ageDoctor[2]){
            $resultAge = ($dateNow[0] - $ageDoctor[0]);
        }else{
            $resultAge = ($dateNow[0] - $ageDoctor[0]) - 1;
        }
        return $resultAge;
    }

    protected $casts = [
        'created_at'=>'date:Y-m-d',
        'active'=>'boolean'
    ];

    //     protected $hidden = [
    //     "deleted_at",
    //     "updated_at",
    //     "email_verified_at",
    //     "remember_token",
    //     "password",
    //     'city_id'
    // ];

    public function findForPassport($username){
        return $this->where('email',$username)->first();
    }

}
