<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory,SoftDeletes;
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
    ];
}
