<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        if(session('type') != 'doctor'){
            return abort(404);
        }
    }
    public function index()
    {
        $patient = Patient::latest()->get();
        return view('patient.index',['patients'=>$patient]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::where('active',true)->get();
        return view('patient.craete',['cities'=>$cities]);
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
            'fname'=>'required|string',
            'lname'=>'required|string',
            'email'=>'required|email',
            'mobile'=>'required|string|max:12|min:7',
            'date_birth'=>'required|string',
            'national_num'=>'required|string|max:12',
            'ensurance_num'=>'required|string|max:12',
            'city'=>'required',
        ]);


        $patient = new Patient();
        $patient->first_name = $request->input('fname');
        $patient->last_name = $request->input('lname');
        $patient->email = $request->input('email');
        $patient->mobile = $request->input('mobile');
        $patient->birth_date = $request->input('date_birth');
        $patient->city_id = $request->input('city');
        $patient->national_num = $request->input('national_num');
        $patient->ensurance_num = $request->input('ensurance_num');
        $patient->active = $request->input('active') == 'on' ? true : false;
        $patient->save();
        return redirect()->route('patients.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('patient.show',['pateint'=>$patient]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        $cities = City::where('active',true)->get();
        return view('patient.edit',['pateint'=>$patient,'cities'=>$cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'fname'=>'required|string',
            'lname'=>'required|string',
            'email'=>'required|email',
            'mobile'=>'required|string|max:12|min:7',
            'date_birth'=>'required|string',
            'national_num'=>'required|string|max:12',
            'ensurance_num'=>'required|string|max:12',
            'city'=>'required',
        ]);

        $patient->first_name = $request->input('fname');
        $patient->last_name = $request->input('lname');
        $patient->email = $request->input('email');
        $patient->mobile = $request->input('mobile');
        $patient->birth_date = $request->input('date_birth');
        $patient->city_id = $request->input('city');
        $patient->national_num = $request->input('national_num');
        $patient->ensurance_num = $request->input('ensurance_num');
        $patient->save();
        return redirect()->route('patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
         $patient->delete();
         return redirect()->back();
    }
        public function trash()
    {
        $patient = Patient::onlyTrashed()->get();
        return view('patient.trash',['patients'=>$patient]);
    }

    public function restore($id)
    {
        Patient::withTrashed()->where('id',$id)->restore();
        return redirect()->route('patients.index');
    }
}
