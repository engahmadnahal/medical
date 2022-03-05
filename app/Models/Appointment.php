<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory,SoftDeletes;

    public function doctor(){
        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }

    public function getStatusPatientAttribute()
    {

        if($this->status == 1){
            $status = __('cms.urgent');
        }elseif($this->status == 2){
            $status = __('cms.mid');
        }else{
            $status = __('cms.normal');
        }

        return $status;

    }

    public function getStatusAppointmentAttribute()
    {



        return $this->urgent == 1 ? __('cms.urgent') : __('cms.normal');

    }
    public function getFormatTimeAttribute()
    {



        return date('H:i:s',strtotime($this->time));

    }

    public function getFormatDateAttribute()
    {



        return date('Y-m-d',strtotime($this->time));

    }

    protected $casts = [
        'time'=>'datetime:H:i a',
    ];


}
