<?php

use App\Http\Controllers\Dashboard\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('lang/{lang}', function ($lang) {
    session()->has('lang') ? session()->forget('lang'):'';
    if ($lang == 'ar') {
        session()->put('lang','ar');
    }else{
        session()->put('lang','en');
    }
    return response()->json($lang, 200);
    
});


Route::prefix('user')->group(function ()
{
    Route::post('register','User\AuthController@register');
    Route::post('login','User\AuthController@login');
    Route::get('verify/{token}','User\VerificationController@verify');
    Route::get('resend/{user}','User\VerificationController@resend');
});
Route::prefix('user')->middleware('auth:sanctum')->group(function () {

    Route::get('profile','User\AuthController@profile');
    Route::post('logout','User\AuthController@logout');

    
});

Route::prefix('dashboard')->group(function(){
    Route::apiResource('admin','Dashboard\AdminController')->except(['create', 'edit']);
    Route::apiResource('user','Dashboard\UserController')->except(['create', 'edit']);
    Route::apiResource('category','Dashboard\CategoryController')->except(['create', 'edit']);
    Route::apiResource('country','Dashboard\countryController')->except(['create', 'edit']);
});




