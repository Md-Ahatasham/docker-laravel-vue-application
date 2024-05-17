<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth/login');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index');
    Route::get('dashboard', 'HomeController@index');
    Route::get('/login', 'HomeController@index');
//    Route::resource('roles','RoleController');
    Route::resource('users','HomeController');
//    Route::resource('activityLogs','ActivityLogController');

});

Auth::routes(['verify' => true]);
Auth::routes();
