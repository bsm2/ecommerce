<?php

use App\Http\Controllers\Api\Dashboard\AdminController;
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

Route::post('register','Api\User\AuthController@register');
Route::post('login','Api\User\AuthController@login');


Route::middleware('auth:sanctum')->group(function () {

    Route::get('profile','Api\User\AuthController@profile');
    Route::any('logout','Api\User\AuthController@logout');

    
});

Route::prefix('dashboard')->group(function(){
    Route::apiResource('admin','Api\Dashboard\AdminController')->except(['create', 'edit']);
    Route::apiResource('category','Api\Dashboard\CategoryController')->except(['create', 'edit']);
    Route::apiResource('country','Api\Dashboard\countryController')->except(['create', 'edit']);
});




