<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables;
use App\DataTables\userDatatable;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDatatable $user)
    {
        $title= __('site.create'); 
        return $user->render('dashboard.users.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create',['title'=>__('site.create')]);
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
            'level'=>'required|in:user,company,vendor',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            
        ]);

        $data['password']= bcrypt($request->password);
        User::create($data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,User $user)
    {
        $title= __('site.edit'); 
        return view('dashboard.users.edit',compact('title','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'level'=>'required|in:user,company,vendor',
            'email' =>  ['required','email',Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|nullable|min:6',
            
        ]);

        if ($request->password) {
            $data['password']= bcrypt($request->password);
        }else{
            //dd($user->password);
            $data['password']=$user->password;
        }
        //dd($data);
        $user->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.user.index');
    }

    public function destroy_all(Request $request)
    {
        if (is_array($request->item)) {
            User::destroy($request->item);
        }

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
        $user->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.user.index');
    }
}
