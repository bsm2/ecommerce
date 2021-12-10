<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CityDatatable;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CityDatatable $city)
    {
        $title= __('site.cities'); 
        return $city->render('dashboard.cities.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.cities.create',['title'=>__('site.create')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'country_id' => 'required',
            
        ]);

        City::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.city.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $title= __('site.edit'); 
        return view('dashboard.cities.edit',compact('title','city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'country_id' => 'required',
            
        ]);

        $city->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.city.index');
    }

    public function destroy_all(Request $request)
    {
        if (is_array($request->item)) {
            City::destroy($request->item);
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.city.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\city  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {

        $city->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.city.index');
    }
}
