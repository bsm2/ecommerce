<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\MallDatatable;
use App\Http\Controllers\Controller;
use App\Models\Mall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Upload;

class MallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MallDatatable $mall)
    {
        $title= __('site.malls'); 
        return $mall->render('dashboard.malls.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.malls.create',['title'=>__('site.create')]);
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
            'email'=>'required|email',
            'phone'=>'required|numeric',
            'facebook'=>'sometimes|nullable|url',
            'twitter'=>'sometimes|nullable|url',
            'website'=>'sometimes|nullable|url',
            'contact'=>'sometimes|nullable|string',
            'country_id'=>'required|numeric',
            'address'=>'sometimes|nullable',
            'lat'=>'sometimes|nullable',
            'lng'=>'sometimes|nullable',
            'logo' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,orwebp',
            
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = Upload::up([
                'file'=>'logo',
                'path'=>'malls',
                'upload_type'=>'single',
            ]); 
        }

        Mall::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.mall.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function edit(Mall $mall)
    {
        $title= __('site.edit'); 
        return view('dashboard.malls.edit',compact('title','mall'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mall $mall)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
            'facebook'=>'sometimes|nullable|url',
            'twitter'=>'sometimes|nullable|url',
            'website'=>'sometimes|nullable|url',
            'country_id'=>'required|numeric',
            'contact'=>'sometimes|nullable|string',
            'address'=>'sometimes|nullable',
            'lat'=>'sometimes|nullable',
            'lng'=>'sometimes|nullable',
            'logo' => 'image|mimes:jpg,jpeg,png,bmp,gif,svg',
            
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = Upload::up([
                'file'=>'logo',
                'path'=>'malls',
                'upload_type'=>'single',
                'delete_file'=>$mall->logo
            ]); 
        }

        $mall->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.mall.index');
    }

    public function destroy_all(Request $request)
    {
        if (is_array($request->item)) {
            foreach ($request->item as $id) {
                $mall=Mall::find($id);
                Storage::delete($mall->logo);
            }
            Mall::destroy($request->item);
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.mall.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mall  $mall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mall $mall)
    {
        Storage::delete($mall->logo);
        $mall->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.mall.index');
    }
}
