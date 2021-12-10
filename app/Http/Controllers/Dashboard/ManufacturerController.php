<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ManufacturerDatatable;
use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Upload;

class manufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManufacturerDatatable $manufacturer)
    {
        $title= __('site.manufacturers'); 
        return $manufacturer->render('dashboard.manufacturers.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.manufacturers.create',['title'=>__('site.create')]);
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
            'address'=>'sometimes|nullable',
            'lat'=>'sometimes|nullable',
            'lng'=>'sometimes|nullable',
            'logo' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,orwebp',
            
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = Upload::up([
                'file'=>'logo',
                'path'=>'manufacturers',
                'upload_type'=>'single',
            ]); 
        }

        Manufacturer::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.manufacturer.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        $title= __('site.edit'); 
        return view('dashboard.manufacturers.edit',compact('title','manufacturer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, manufacturer $manufacturer)
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
            'address'=>'sometimes|nullable',
            'lat'=>'sometimes|nullable',
            'lng'=>'sometimes|nullable',
            'logo' => 'image|mimes:jpg,jpeg,png,bmp,gif,svg',
            
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = Upload::up([
                'file'=>'logo',
                'path'=>'manufacturers',
                'upload_type'=>'single',
                'delete_file'=>$manufacturer->logo
            ]); 
        }

        $manufacturer->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.manufacturer.index');
    }

    public function destroy_all(Request $request)
    {
        if (is_array($request->item)) {
            foreach ($request->item as $id) {
                $manufacturer=Manufacturer::find($id);
                Storage::delete($manufacturer->logo);
            }
            Manufacturer::destroy($request->item);
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.manufacturer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        Storage::delete($manufacturer->logo);
        $manufacturer->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.manufacturer.index');
    }
}
