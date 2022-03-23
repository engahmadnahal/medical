<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->authorizeResource(Patient::class,'patient');
    }

    public function index()
    {
        $patient = Patient::latest()->withCount('permissions')->get();
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
            'mobile'=>'required|string',
            'date_birth'=>'required|string',
            'national_num'=>'required|string|max:20',
            'ensurance_num'=>'required|string|max:20',
            'city'=>'required',
            'password'=>'required|min:6',
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
        $patient->password = Hash::make($request->input('password'));
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
            'password'=>'required|min:6',

        ]);

        $patient->first_name = $request->input('fname');
        $patient->last_name = $request->input('lname');
        $patient->email = $request->input('email');
        $patient->mobile = $request->input('mobile');
        $patient->birth_date = $request->input('date_birth');
        $patient->city_id = $request->input('city');
        $patient->national_num = $request->input('national_num');
        $patient->ensurance_num = $request->input('ensurance_num');
        $patient->password = $request->input('password');
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


    /**
     * Show Page for update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function editUserPermission(Request $request , Patient $patient ){
        $permissions = Permission::where('guard_name','user')->get();
        $userPermissions = $patient->permissions;
        if(count($userPermissions) > 0){
            foreach($permissions as $permission){
                $permission->setAttribute('assign',false);
                foreach($userPermissions as $rolePermission){
                    if($rolePermission->id == $permission->id){
                        $permission->setAttribute('assign',true);
                    }
                }
            }
        }
        return view('patient.user-permissions',['patient'=>$patient,'permissions'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function updateUserPermission(Request $request , Patient $patient ){

        $validator = Validator($request->all(),[
            'permission_id' =>'required|exists:permissions,id'
        ]);

        if(!$validator->fails()){
            $permission = Permission::findOrFail($request->input('permission_id'));
            if($patient->hasPermissionTo($permission)){
                $patient->revokePermissionTo($permission);
            }else{
                $patient->givePermissionTo($permission);
            }
            return response()->json(['msg'=>'Success add this permission'],Response::HTTP_OK);
        }else{
        return response()->json(['msg'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }
}
