<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Traits\ApiResponse;

class UserController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::paginate(5);
        return $this->success('this is all users',$users);

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
        $data['verified']= false;
        $data['verification_token']= User::generateVerificationCode();
        $user = User::create($data);
        return $this->success(__('site.added_successfully'),$user);
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
            $data['password']=$user->password;
        }
        if ($request->email) {
            $data['verified']= false;
            $data['verification_token']= User::generateVerificationCode();
        }
        $user->update($data);
        return $this->success(__('site.updated_successfully'),$user);
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
        return $this->success( __('site.deleted_successfully'));

    }
}
