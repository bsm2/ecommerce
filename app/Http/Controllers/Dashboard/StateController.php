<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\StateDatatable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Form;
use Upload;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StateDatatable $state)
    {
        $title= __('site.states'); 
        return $state->render('dashboard.states.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->ajax()) {
            if ($request->has('country_id')) {
                $cities=City::where('country_id',$request->country_id)->pluck('name_'.lang(),'id');
                $select = $request->has('select')? $request->select:'';
                return Form::select('city_id',$cities,$select, ['class'=>'form-control','placeholder'=>'choose city']);
            }
        }
        return view('dashboard.states.create',['title'=>__('site.create')]);
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
            'city_id' => 'required',
            
        ]);

        State::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.state.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\state  $state
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\state  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $title= __('site.edit'); 
        return view('dashboard.states.edit',compact('title','state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\state  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, state $state)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            
        ]);

        $state->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.state.index');
    }

    public function destroy_all(Request $request)
    {
        if (is_array($request->item)) {
            State::destroy($request->item);
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.state.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\state  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {

        $state->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.state.index');
    }
}
