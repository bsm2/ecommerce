<?php

namespace App\Http\Controllers\Api\Dashboard;


use App\Http\Controllers\Controller;
use App\Http\Resources\CountryCollection;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use Illuminate\Support\Facades\Storage;
use Upload;

class CountryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $countries= new CountryCollection(Country::paginate(5));
        
        return $this->getData('this is all countries',$countries);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'mob' => 'required',
            'code' => 'required|min:3',
            'currency'=>'required',
            'logo' => 'required|image|mimes:jpg,jpeg,png,bmp,gif,svg,orwebp',
            
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = Upload::up([
                'file'=>'logo',
                'path'=>'countries',
                'upload_type'=>'single',
            ]); 
        }

        Country::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.country.index');
    }

    public function edit(Country $country)
    {
        $title= __('site.edit'); 
        return view('dashboard.countries.edit',compact('title','country'));
    }

    public function update(Request $request, Country $country)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'mob' => 'required',
            'code' => 'required|min:3',
            'currency'=>'required',
            'logo' => 'image|mimes:jpg,jpeg,png,bmp,gif,svg',
            
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = Upload::up([
                'file'=>'logo',
                'path'=>'countries',
                'upload_type'=>'single',
                'delete_file'=>$country->logo
            ]); 
        }

        $country->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.country.index');
    }


    public function destroy(Country $country)
    {
        Storage::delete($country->logo);
        $country->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.country.index');
    }
}
