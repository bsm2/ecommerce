<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;




Route::get('lang/{lang}', function ($lang) {
    session()->has('lang') ? session()->forget('lang'):'';
    if ($lang == 'ar') {
        session()->put('lang','ar');
    }else{
        session()->put('lang','en');
    }
    return back();
});



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login','AdminAuth@showLogin')->name('showLogin');
    Route::post('login','AdminAuth@doLogin')->name('doLogin');
    Route::any('logout','AdminAuth@logout')->name('logout');
    Route::get('forgot/password','AdminAuth@forgot_password')->name('forgot.password');
    Route::post('forgot/password','AdminAuth@post_forgot_password')->name('post.forgot.password');
    Route::get('reset/password/{token}','AdminAuth@reset_password');
    Route::post('reset/password/{token}','AdminAuth@do_reset_password')->name('reset.password');
}); 


Route::prefix('dashboard')->name('dashboard.')->middleware(['auth:admin'])->group(function(){
    //set gaurd to this routes to be admin
    Config::set('auth.defines','admins');

    Route::get('/', function () {return view('dashboard.home');})->name('home');
    //controll admins
    Route::resource('admin', 'AdminController');
    Route::delete('admin/destroy/all','AdminController@destroy_all' )->name('admin.destroy.all');
    //admin settings
    Route::get('settings', 'SettingController@index')->name('settings.index');
    Route::put('settings/{setting}', 'SettingController@update')->name('settings.update');
    //control users
    Route::resource('user', 'UserController');
    Route::delete('user/destroy/all','UserController@destroy_all' )->name('user.destroy.all');
    //control countries
    Route::resource('country', 'CountryController');
    Route::delete('country/destroy/all','CountryController@destroy_all' )->name('country.destroy.all');
    //control cities
    Route::resource('city', 'CityController');
    Route::delete('city/destroy/all','CityController@destroy_all' )->name('city.destroy.all');
    //control cities
    Route::resource('state', 'StateController');
    Route::delete('state/destroy/all','StateController@destroy_all' )->name('state.destroy.all');
    //control cities
    Route::resource('category', 'CategoryController');
    //control trademark
    Route::resource('trademark', 'TrademarkController');
    Route::delete('trademark/destroy/all','TrademarkController@destroy_all' )->name('trademark.destroy.all');
    //control manufacturer
    Route::resource('manufacturer', 'ManufacturerController');
    Route::delete('manufacturer/destroy/all','ManufacturerController@destroy_all' )->name('manufacturer.destroy.all');
    //control shipping
    Route::resource('shipping', 'ShippingController');
    Route::delete('shipping/destroy/all','ShippingController@destroy_all' )->name('shipping.destroy.all');
    //control mall
    Route::resource('mall', 'MallController');
    Route::delete('mall/destroy/all','MallController@destroy_all' )->name('mall.destroy.all');
    //control color
    Route::resource('color', 'ColorController');
    Route::delete('color/destroy/all','ColorController@destroy_all' )->name('color.destroy.all');
    //control size
    Route::resource('size', 'SizeController');
    Route::delete('size/destroy/all','SizeController@destroy_all' )->name('size.destroy.all');
    //control weight
    Route::resource('weight', 'WeightController');
    Route::delete('weightt/destroy/all','WeightController@destroy_all' )->name('weight.destroy.all');
    //control product
    Route::resource('product', 'ProductController');
    Route::delete('product/destroy/all','ProductController@destroy_all' )->name('product.destroy.all');
    //upload product images
    Route::post('upload/image/{id}','ProductController@upload_file');
    Route::post('delete/image','ProductController@delete_file');
    Route::post('update/image/{id}','ProductController@update_image');
    Route::post('delete/product/image/{id}','ProductController@delete_image');
    Route::post('shipping/info','ProductController@shipping_info')->name('shipping.info');

    //control role
    Route::resource('role', 'RoleController');
    Route::delete('role/destroy/all','RoleController@destroy_all' )->name('role.destroy.all');

});

