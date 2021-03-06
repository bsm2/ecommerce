<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['Maintenance'])->group(function () {
    Route::get('/', function () {
        return view('style.home');
    });
});

Route::get('maintenance', function () {
    if (settings()->status == 'open') {
        return redirect('/');
    } 
    return view('style.maintenance');
});


Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
