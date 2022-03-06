<?php

namespace App\Http\Controllers;

use App\Models\AuthCheck;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AuthCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.signin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AuthCheck  $authCheck
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {


    }

    public function check(Request $request)
    {

        $info = [];
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string',
            'user'=>'required'
        ]);
        if($request->user == 'doctor'){
            $doctor = Doctor::where('email',$request->email)->first();
            if(!$doctor){
            session()->flash('msg',__('cms.error_user'));
            return redirect()->back();
            }
            if($request->password == $doctor->password){
                array_push($info,$doctor);
                session()->put('logged',$info);
                session()->put('type','doctor');
                return redirect()->route('index');
            }
            session()->flash('msg',__('cms.error_pass'));
            return redirect()->back();

        }else{
            $patient = Patient::where('email',$request->email)->first();
            if(!$patient){
            session()->flash('msg',__('cms.error_user'));
            return redirect()->back();
            }
            if($request->password == $patient->password){
                array_push($info,$patient);
                session()->put('logged',$info);
                session()->put('type','patient');
                return redirect()->route('index');
            }
            session()->flash('msg',__('cms.error_pass'));
            return redirect()->back();

        }

    }

    public function checkDoctor(){
        $this->middleware(function ($request, $next) {
            if(session()->get('type') != 'doctor'){
                return abort(404);
            }
        return $next($request);
        });

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuthCheck  $authCheck
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuthCheck  $authCheck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuthCheck  $authCheck
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
