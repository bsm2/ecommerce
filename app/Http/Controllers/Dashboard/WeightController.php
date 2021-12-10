<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\WeightDatatable;
use App\Http\Controllers\Controller;
use App\Models\Weight;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Upload;

class weightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WeightDatatable $weight)
    {
        $title= __('site.weights'); 
        return $weight->render('dashboard.weights.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.weights.create',['title'=>__('site.create')]);
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
            
        ]);

        Weight::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.weight.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function edit(Weight $weight)
    {
        $title= __('site.edit'); 
        return view('dashboard.weights.edit',compact('title','weight'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weight $weight)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            
        ]);

        $weight->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.weight.index');
    }

    public function destroy_all(Request $request)
    {
        if (is_array($request->item)) {
            Weight::destroy($request->item);
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.weight.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weight $weight)
    {

        $weight->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.weight.index');
    }
}
