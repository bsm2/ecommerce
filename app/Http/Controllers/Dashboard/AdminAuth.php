<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
//use Illuminate\Foundation\Dashboard\AuthenticatesUsers;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class AdminAuth extends Controller
{

    //use AuthenticatesUsers;
    
    // protected $redirectTo = '/dashboard';

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function showLogin()
    {
        return view('dashboard.login');
    }


    public function doLogin(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember_me= $request->rememberme == 1? true : false;
        if (auth()->guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$remember_me)) {
            return redirect()->route('dashboard.home');
            
        }else{
            return redirect()->route('admin.showLogin');
        } 

    }

    public function logout(){

        auth()->guard('admin')->logout();
        return redirect()->route('admin.showLogin');

    }

    public function forgot_password(){
        return view('dashboard.forgot_password');
    }
    public function post_forgot_password(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('email',$request->email)->first();
        //dd($admin);
        if (!empty($admin)) {
            $token = app('auth.password.broker')->createToken($admin);
            $data = DB::table('password_resets')->insert([
                'email'=>$admin->email,
                'token'=>$token,
                'created_at'=>Carbon::now(),
            ]);
            Mail::to($admin->email)->send(new AdminResetPassword(['data'=>$admin,'token'=>$token]));
            session()->flash('success', __('site.mail_sent'));
            return back();
        }
        return back();
    }

    public function reset_password($token){
        $check = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();
		if ($check) {
			return view('dashboard.reset_password')->with(['data' => $check]);
		} else {
			return redirect()->route('forgot.password');
		}
    }

    public function do_reset_password(Request $request,$token){
        //dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $check = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();
        if ($check) {

            $admin = Admin::where('email',$check->email)->update([
                'email'=>$check->email,
                'password'=>bcrypt($request->password),
            ]);

            DB::table('password_resets')->where('email',$request->email)->delete();

            auth()->guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],true);
            return redirect()->route('dashboard.home');

        }else {
            return redirect()->route('admin.forgot.password');
        }
        
        
		
    }
}
