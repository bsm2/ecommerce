<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ShippingDatatable;
use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Upload;

class shippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingDatatable $shipping)
    {
        $title= __('site.shippings'); 
        return $shipping->render('dashboard.shippings.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.shippings.create',['title'=>__('site.create')]);
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
            'user_id'=>'required',
            'address'=>'sometimes|nullable',
            'lat'=>'sometimes|nullable',
            'lng'=>'sometimes|nullable',
        ]);

        Shipping::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.shipping.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        $title= __('site.edit'); 
        return view('dashboard.shippings.edit',compact('title','shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'user_id'=>'required',
            'address'=>'sometimes|nullable',
            'lat'=>'sometimes|nullable',
            'lng'=>'sometimes|nullable',
            
        ]);

        $shipping->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.shipping.index');
    }

    public function destroy_all(Request $request)
    {
        if (is_array($request->item)) {
            foreach ($request->item as $id) {
                $shipping=Shipping::find($id);
            }
            Shipping::destroy($request->item);
        }
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.shipping.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.shipping.index');
    }
}
