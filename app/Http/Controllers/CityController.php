<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
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
        $cities = City::latest()->get();
        return view('city.index',['cities'=>$cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('city.craete');
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
            'name_en'=>'required|string|max:10|min:5',
            'name_ar'=>'required|string|max:10|min:5',
        ]);
        $city = new City();
        $city->name_ar = $request->input('name_ar');
        $city->name_en = $request->input('name_en');
        $city->active = $request->input('active') == 'on' ? true : false;
        $city->save();
        return redirect()->route('cities.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('city.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view('city.edit',['city'=>$city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name_en'=>'required|string|max:10|min:5',
            'name_ar'=>'required|string|max:10|min:5',
        ]);
        $city->name_ar = $request->input('name_ar');
        $city->name_en = $request->input('name_en');
        $city->active = $request->input('active') == 'on' ? true : false;
        $city->save();
        return redirect()->route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('cities.index');
    }

    public function trash()
    {
        $cities  = City::onlyTrashed()->get();
        return view('city.trash',['cities' => $cities]);
    }

    public function restore($id)
    {
        City::withTrashed()->where('id',$id)->restore();
        return redirect()->back();
    }
}
