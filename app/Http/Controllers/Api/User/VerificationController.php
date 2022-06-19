<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserVerification;
use App\Http\Traits\ApiResponse;

class VerificationController extends Controller
{
    use ApiResponse;

    public function verify($token)
    {
        $user=User::where('verification_token',$token)->firstOrFail();
        $user->verified=true;
        $user->verification_token=null;
        $user->save();

        return $this->success('The acount has been verfified successfuly');
    }

    public function resend(User $user)
    {
        if ($user->verified) {
            return $this->failure('user already verified',[],409);
        }
        if ($user->verification_token == null) {
            $user->update([
                'verification_token'=> User::generateVerificationCode()
            ]);
        }
        Mail::to($user)->send(new UserVerification($user));
        return $this->success('verification email is sent',$user);
    }

}
