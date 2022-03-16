<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Doctor;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator ;
use Symfony\Component\HttpFoundation\Response;

class DoctorController extends Controller
{

    public function __construct(){
        $auth = new AuthCheckController();
        $auth->checkDoctor();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::latest()->get();
        return view('doctor.index',['doctors'=>$doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {

        $cities = City::all();
        $specialites = Specialite::all();
        return view('doctor.craete',['cities'=>$cities,'specialites'=>$specialites]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $validator = Validator($request->all(),[
            'fname'=>'required|string',
            'lname'=>'required|string',
            'email'=>'required|email',
            'mobile'=>'required|string|max:12|min:7',
            'work_id'=>'required|string|min:5|max:15',
            'date_birth'=>'required|string',
            'password'=>'required|string|min:6',
            'start_time'=>'required|string',
            'end_time'=>'required|string',
            'cv'=>'required',
            'avater'=>'required',
            'specialite'=>'required',
            'city'=>'required',
            'degree'=>'required',
            'gender'=>'required',
        ]);

        // Check if nothing errors
        if(!$validator->fails()){
            $fileCV = $request->file('cv');
            // $fileSize = $fileCV->getSize();
            $filename = time().".".$fileCV->getClientOriginalExtension();
            $fileCV->move('upload/files',$filename);

            // Upload Avater
            $fileAvater = $request->file('avater');
            // $fileSizeAvater = $fileAvater->getSize();
            $filename_avater = time().".".$fileAvater->getClientOriginalExtension();
            $fileAvater->move('upload/files',$filename_avater);


            $doctor = new Doctor();
            $doctor->city_id = $request->input('city');
            $doctor->specialite_id = $request->input('specialite');
            $doctor->first_name = $request->input('fname');
            $doctor->last_name = $request->input('lname');
            $doctor->mobile = $request->input('mobile');
            $doctor->gender = $request->input('gender');
            $doctor->work_id = $request->input('work_id');
            $doctor->degree = $request->input('degree');
            $doctor->birth_date = $request->input('date_birth');
            $doctor->password = $request->input('password');
            $doctor->email = $request->input('email');
            $doctor->start_time = $request->input('start_time');
            $doctor->end_time = $request->input('end_time');
            $doctor->avater = $filename_avater;
            $doctor->cv = $filename;
            $isSave = $doctor->save();
            return response()->json(['msg'=>'Success creating'],$isSave ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['msg'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);

        // $request->validate([
        //     'fname'=>'required|string',
        //     'lname'=>'required|string',
        //     'email'=>'required|email',
        //     'mobile'=>'required|string|max:12|min:7',
        //     'work_id'=>'required|string|min:5|max:15',
        //     'date_birth'=>'required|string',
        //     'password'=>'required|string|min:6',
        //     'start_time'=>'required|string',
        //     'end_time'=>'required|string',
        //     'cv'=>'required|mimes:doc,docx,pdf,txt',
        //     'avater'=>'required|image',
        //     'specialite'=>'required',
        //     'city'=>'required',
        //     'degree'=>'required',
        //     'gender'=>'required',
        // ]);



            // $fileCV = $request->file('cv');
            // // $fileSize = $fileCV->getSize();
            // $filename = time().".".$fileCV->getClientOriginalExtension();
            // $fileCV->move('upload/files',$filename);

            // // Upload Avater
            // $fileAvater = $request->file('avater');
            // // $fileSizeAvater = $fileAvater->getSize();
            // $filename_avater = time().".".$fileAvater->getClientOriginalExtension();
            // $fileAvater->move('upload/files',$filename_avater);


            // $doctor = new Doctor();
            // $doctor->city_id = $request->input('city');
            // $doctor->specialite_id = $request->input('specialite');
            // $doctor->first_name = $request->input('fname');
            // $doctor->last_name = $request->input('lname');
            // $doctor->mobile = $request->input('mobile');
            // $doctor->gender = $request->input('gender');
            // $doctor->work_id = $request->input('work_id');
            // $doctor->degree = $request->input('degree');
            // $doctor->birth_date = $request->input('date_birth');
            // $doctor->password = $request->input('password');
            // $doctor->email = $request->input('email');
            // $doctor->start_time = $request->input('start_time');
            // $doctor->end_time = $request->input('end_time');
            // $doctor->avater = $filename_avater;
            // $doctor->cv = $filename;
            // $doctor->save();
            // return redirect()->route('doctors.index');




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {

        return view('doctor.show',['doctor'=>$doctor]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {

        $cities = City::where('active',true)->get();
        $specialites = Specialite::where('active',true)->get();
        return view('doctor.edit',['doctor'=>$doctor,'cities'=>$cities,'specialites'=>$specialites]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {

        $request->validate([
            'fname'=>'required|string',
            'lname'=>'required|string',
            'email'=>'required|email',
            'mobile'=>'required|string|max:12|min:7',
            'work_id'=>'required|string|min:5|max:15',
            'date_birth'=>'required|string',
            'password'=>'required|string|min:6',
            'start_time'=>'required|string',
            'end_time'=>'required|string',
            'cv'=>'required|mimes:doc,docx,pdf,txt',
            'avater'=>'required|image',
            'specialite'=>'required',
            'city'=>'required',
            'degree'=>'required',
            'gender'=>'required',
        ]);




            $fileCV = $request->file('cv');
            // $fileSize = $fileCV->getSize();
            $filename = time().".".$fileCV->getClientOriginalExtension();
            $fileCV->move('upload/files',$filename);

            // Upload Avater
            $fileAvater = $request->file('avater');
            // $fileSizeAvater = $fileAvater->getSize();
            $filename_avater = time().".".$fileAvater->getClientOriginalExtension();
            $fileAvater->move('upload/files',$filename_avater);


            $doctor->city_id = $request->input('city');
            $doctor->specialite_id = $request->input('specialite');
            $doctor->first_name = $request->input('fname');
            $doctor->last_name = $request->input('lname');
            $doctor->mobile = $request->input('mobile');
            $doctor->gender = $request->input('gender');
            $doctor->work_id = $request->input('work_id');
            $doctor->degree = $request->input('degree');
            $doctor->birth_date = $request->input('date_birth');
            $doctor->password = $request->input('password');
            $doctor->email = $request->input('email');
            $doctor->start_time = $request->input('start_time');
            $doctor->end_time = $request->input('end_time');
            $doctor->avater = $filename_avater;
            $doctor->cv = $filename;
            $doctor->save();
            return redirect()->route('doctors.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->back();

    }

    public function trash()
    {
        $doctors = Doctor::onlyTrashed()->get();
        return view('doctor.trash',['doctors'=>$doctors]);
    }

    public function restore($id)
    {
        Doctor::withTrashed()->where('id',$id)->restore();
        return redirect()->back();
    }

}
