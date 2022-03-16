<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory,SoftDeletes;

    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function specialite(){
        return $this->belongsTo(Specialite::class,'specialite_id','id');
    }

    public function pateins(){
        return $this->belongsToMany(Patient::class,'appointments','doctor_id','patient_id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class,'doctor_id','id');
    }

    public function getGenderDoctorAttribute()
    {
        return $this->gender == 'M' ? __('cms.male') : __('cms.female');
    }
    public function getDegreeDoctorAttribute()
    {
        return $this->degree == 'master' ? __('cms.master') : __('cms.doctors');
    }


    public function getAgeDoctorAttribute()
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
    ];
}
