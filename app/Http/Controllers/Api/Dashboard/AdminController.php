<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminCollection;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Http\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins=Admin::all();
        $admins=$this->sortData($admins);
        $admins=$this->paginate($admins);
        $admins= new AdminCollection($admins);
        return $this->success('this is all admins',$admins);
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
        return $this->success('admin added ',$admin);

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
            $data['password']=$admin->password;
        }
        $admin->update($data);
        return $this->success('admin updated ',$admin);
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
        return $this->success('admin deleted');
    }
}
