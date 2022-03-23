<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public $session_type;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {


        $appointments = Appointment::latest()->get();
        return view('appointment.index',['appointments'=>$appointments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       $appointments = Appointment::all();
       $patients = Patient::all();
       $doctors = Doctor::all();
       return view('appointment.craete',['appointments'=>$appointments,'patients'=>$patients,'doctors'=>$doctors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'doctor_id'=>'required',
            'pateint_id'=>'required',
            'status'=>'required',
            'urgent'=>'required',
            'report'=>'required|string',
            'time'=>'required',
            'date'=>'required',

        ]);
        $appointment = new Appointment();
        $appointment->doctor_id = $request->input('doctor_id');
        $appointment->patient_id = $request->input('pateint_id');
        $appointment->status = $request->input('status');
        $appointment->urgent = $request->input('urgent');
        $appointment->report = $request->input('report');
        $appointment->time = $request->input('time');
        $appointment->date = $request->input('date');
        $appointment->save();
        return redirect()->route('appointment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {

        return view('appointment.show',['appointment'=>$appointment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
       $patients = Patient::all();
       $doctors = Doctor::all();
        return view('appointment.edit',['appointment'=>$appointment,'patients'=>$patients,'doctors'=>$doctors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'doctor_id'=>'required',
            'pateint_id'=>'required',
            'status'=>'required',
            'urgent'=>'required',
            'report'=>'required|string',
            'time'=>'required',
            'date'=>'required',
        ]);
        $appointment->doctor_id = $request->input('doctor_id');
        $appointment->patient_id = $request->input('pateint_id');
        $appointment->status = $request->input('status');
        $appointment->urgent = $request->input('urgent');
        $appointment->report = $request->input('report');
        $appointment->time = $request->input('time');
        $appointment->date = $request->input('date');
        $appointment->save();
        return redirect()->route('appointment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->back();
    }

    public function trash()
    {
        $appointment  = Appointment::onlyTrashed()->get();
        return view('appointment.trash',['appointments' => $appointment]);
    }

    public function restore($id)
    {
        Appointment::withTrashed()->where('id',$id)->restore();
        return redirect()->back();
    }
}
