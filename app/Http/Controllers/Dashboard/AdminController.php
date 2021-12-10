<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\DataTables;
use App\DataTables\AdminDatatable;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDatatable $admin)
    {
        $title= __('site.admins');
        return $admin->render('dashboard.admins.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admins.create',['title'=>__('site.create')]);
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
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'role'=>'required'
            
        ]);

        $data['password']= bcrypt($request->password);
        $admin=Admin::create($data);
        $admin->assignRole($request->role);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Admin $admin)
    {
        $title= __('site.edit'); 
        return view('dashboard.admins.edit',compact('title','admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' =>  ['required','email',Rule::unique('admins')->ignore($admin->id)],
            'password' => 'sometimes|nullable|min:6',
            
        ]);

        if ($request->password) {
            $data['password']= bcrypt($request->password);
        }else{
            //dd($admin->password);
            $data['password']=$admin->password;
        }
        //dd($data);
        $admin->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.admin.index');
    }

    public function destroy_all(Request $request)
    {
        if (is_array($request->item)) {
            Admin::destroy($request->item);
        }

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        
        $admin->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.admin.index');
    }
}
