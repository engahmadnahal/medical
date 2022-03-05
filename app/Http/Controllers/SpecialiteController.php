<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use Illuminate\Http\Request;

class SpecialiteController extends Controller
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
        $specialites = Specialite::latest()->get();
        return view('specialite.index',['specialites'=>$specialites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('specialite.craete');
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
            'name_en'=>'required|string|max:20|min:5',
            'name_ar'=>'required|string|max:20|min:5',
        ]);
        $specialite = new Specialite();
        $specialite->name_ar = $request->input('name_ar');
        $specialite->name_en = $request->input('name_en');
        $specialite->active = $request->input('active') == 'on' ? true : false;
        $specialite->save();
        return redirect()->route('specialites.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function show(Specialite $specialite)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialite $specialite)
    {
        return view('specialite.edit',['specialite'=>$specialite]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialite $specialite)
    {
        $request->validate([
            'name_en'=>'required|string|max:20|min:5',
            'name_ar'=>'required|string|max:20|min:5',
        ]);
        $specialite->name_ar = $request->input('name_ar');
        $specialite->name_en = $request->input('name_en');
        $specialite->active = $request->input('active') == 'on' ? true : false;
        $specialite->save();
        return redirect()->route('specialites.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialite $specialite)
    {
        $specialite->delete();
        return redirect()->route('specialites.index');
    }

    public function trash()
    {
        $specialite  = Specialite::onlyTrashed()->get();
        return view('specialite.trash',['specialites' => $specialite]);
    }

    public function restore($id)
    {
        Specialite::withTrashed()->where('id',$id)->restore();
        return redirect()->back();
    }
}
