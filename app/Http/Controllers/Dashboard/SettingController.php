<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Upload;

class SettingController extends Controller
{

    public function index()
    {
        $settings=Setting::orderBy('id', 'DESC')->first();
        $title= __('site.settings');
        return view('dashboard.settings',compact('title','settings'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'logo' => 'image|mimes:jpg,jpeg,png,bmp,gif,svg,orwebp',
            'icon' => 'image|mimes:jpg,jpeg,png,bmp,gif,svg,orwebp'
        ]);

        $data= $request->except('icon','logo','_method','_token');

        if ($request->hasFile('logo')) {
            $data['logo'] = Upload::up([
                'file'=>'logo',
                'path'=>'settings',
                'upload_type'=>'single',
                'delete_file'=>$setting->logo
            ]); 
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = Upload::up([
                'file'=>'icon',
                'path'=>'settings',
                'upload_type'=>'single',
                'delete_file'=>$setting->icon
            ]); 
        }
        //dd($data);
        $setting->update($data);
        //session()->put('lang',$data['main_lang']);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.home');
    }

}

