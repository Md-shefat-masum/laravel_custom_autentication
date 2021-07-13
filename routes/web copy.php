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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/register_new_user','HomeController@register_new_user')->name('register_new_user');
Route::post('/login_user','HomeController@login_user')->name('login_user');
Route::post('/check_logged','HomeController@check_logged')->name('check_logged');
Route::post('/log_out','HomeController@log_out')->name('log_out');
