<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\SizeDatatable;
use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Upload;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SizeDatatable $size)
    {
        $title= __('site.sizes'); 
        return $size->render('dashboard.sizes.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.sizes.create',['title'=>__('site.create')]);
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
            'category_id' => 'required|numeric',
            'is_public'=>'required|in:yes,no'
            
        ]);

        Size::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.size.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        $title= __('site.edit'); 
        return view('dashboard.sizes.edit',compact('title','size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'category_id' => 'required|numeric',
            'is_public'=>'required|in:yes,no'
            
        ]);

        $size->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.size.index');
    }

    public function destroy_all(Request $request)
    {
        if (is_array($request->item)) {
            Size::destroy($request->item);
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.size.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {

        $size->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.size.index');
    }
}
