<?php

namespace App\Providers;

use App\Mail\UserMailChanged;
use App\Mail\UserVerification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        User::created(function($user)
        {
            Mail::to($user)->send(new UserVerification($user));
        });

        User::updated(function($user)
        {
            if ($user->isDirty('email')) {
                Mail::to($user)->send(new UserMailChanged($user));
            }
        });
    }
}
