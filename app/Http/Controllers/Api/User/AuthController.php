<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Traits\ApiResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    use ApiResponse;



    // register new user

    public function register(Request $request)
    {
        // $data= $request->all();

        // $validator = Validator::make($data,);

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:7',

        ]);

        // if ($validator->fails()) {
        //     return $this->failure('validation errors',$validator->errors(),422);
        // }

        $data['password']= bcrypt($request->password);
        $user=User::create($data);
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success('successfuly created',[
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user'=>$user
        ]); 
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email'=>$request->email,'password'=>$request->password])) {
            $user= User::where('email',$request->email)->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->success('successfully logged in',[
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user'=>$user
            ]); 
        }else{
            return $this->failure('please enter vaild data');
        } 
    }

    public function profile(Request $request)
    {
        return $this->success('user profile',$request->user());

    }

    public function logout(Request $request){

        //request()->user()->currentAccessToken()->delete();
        $request->user()->tokens()->delete();
        auth('web')->logout();
        return $this->success('successfuly logged out');

    }
}
