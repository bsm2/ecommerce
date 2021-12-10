<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ColorDatatable;
use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Upload;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ColorDatatable $color)
    {
        $title= __('site.colors'); 
        return $color->render('dashboard.colors.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.colors.create',['title'=>__('site.create')]);
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
            'color' => 'required|string',
            
        ]);

        Color::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.color.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        $title= __('site.edit'); 
        return view('dashboard.colors.edit',compact('title','color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'color' => 'required|string',
            
        ]);

        $color->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.color.index');
    }

    public function destroy_all(Request $request)
    {
        if (is_array($request->item)) {
            Color::destroy($request->item);
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.color.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {

        $color->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.color.index');
    }
}
