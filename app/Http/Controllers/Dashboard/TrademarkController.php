<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\TrademarkDatatable;
use App\Http\Controllers\Controller;
use App\Models\Trademark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Upload;

class trademarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TrademarkDatatable $trademark)
    {
        $title= __('site.trademarks'); 
        return $trademark->render('dashboard.trademarks.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.trademarks.create',['title'=>__('site.create')]);
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
            'logo' => 'required|image|mimes:jpg,jpeg,png,bmp,gif,svg,orwebp',
            
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = Upload::up([
                'file'=>'logo',
                'path'=>'trademarks',
                'upload_type'=>'single',
            ]); 
        }

        Trademark::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.trademark.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\trademark  $trademark
     * @return \Illuminate\Http\Response
     */
    public function show(trademark $trademark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\trademark  $trademark
     * @return \Illuminate\Http\Response
     */
    public function edit(Trademark $trademark)
    {
        $title= __('site.edit'); 
        return view('dashboard.trademarks.edit',compact('title','trademark'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\trademark  $trademark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trademark $trademark)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'logo' => 'image|mimes:jpg,jpeg,png,bmp,gif,svg',
            
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = Upload::up([
                'file'=>'logo',
                'path'=>'trademarks',
                'upload_type'=>'single',
                'delete_file'=>$trademark->logo
            ]); 
        }

        $trademark->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.trademark.index');
    }

    public function destroy_all(Request $request)
    {
        if (is_array($request->item)) {
            foreach ($request->item as $id) {
                $trademark=Trademark::find($id);
                Storage::delete($trademark->logo);
            }
            Trademark::destroy($request->item);
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.trademark.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\trademark  $trademark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trademark $trademark)
    {
        Storage::delete($trademark->logo);
        $trademark->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.trademark.index');
    }
}
