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
    1. session base login.
    2. show user informaion.
    3. custom middleware.
    4. laravel middleware.
    5. helper class.
    6. route group.

*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users', [App\Http\Controllers\CustomUserController::class, 'users'])->name('users')->middleware('check_auth');

Route::group( ['middleware'=>['check_teacher_auth'] ],function(){
    
    Route::get('/teachers', [App\Http\Controllers\CustomUserController::class, 'teacher'])->name('teacher');

    Route::get('/teacher-info', [App\Http\Controllers\CustomUserController::class, function(){
        $str = " <a href='/teachers'> all teacher</a> <br> <h1>teacher info</h1>";
        echo $str;
    }]);

    Route::get('/teacher-add', [App\Http\Controllers\CustomUserController::class, function(){
        $str = " <a href='/teachers'> all teacher</a> <br> <h1>teacher add</h1>";
        echo $str;
    }]);
});

Route::group( ['middleware'=>['check_student_auth'] ],function(){
    Route::get('/students', [App\Http\Controllers\CustomUserController::class, 'student'])->name('student');
    Route::get('/student-info', [App\Http\Controllers\CustomUserController::class, function(){
        $str = " <a href='/students'> all student</a> <br> <h1>student info</h1>";
        echo $str;
    }]);
    Route::get('/student-add', [App\Http\Controllers\CustomUserController::class, function(){
        $str = " <a href='/students'> all student</a> <br> <h1>student add</h1>";
        echo $str;
    }]);
});

Route::group( ['middleware'=>['check_principal_auth'] ],function(){
    Route::get('/principals', [App\Http\Controllers\CustomUserController::class, 'principal'])->name('principal');
    Route::get('/principal-info', [App\Http\Controllers\CustomUserController::class, function(){
        $str = " <a href='/principals'> all principal</a> <br> <h1>principal info</h1>";
        echo $str;
    }]);
    Route::get('/principal-add', [App\Http\Controllers\CustomUserController::class, function(){
        $str = " <a href='/principals'> all principal</a> <br> <h1>principal add</h1>";
        echo $str;
    }]);

});


Route::group(['middleware' => ['check_login']], function () {
    Route::get('/custom-login', 'CustomController@custom_login')->name('custom_login');
    Route::get('/custom-register', 'CustomController@custom_register')->name('custom_register');
});

// custom login
Route::get('/student-login', 'CustomController@student_login')->name('student_login')->middleware('check_student_login');
Route::get('/teacher-login', 'CustomController@teacher_login')->name('teacher_login')->middleware('check_teacher_login');
Route::get('/principal-login', 'CustomController@principal_login')->name('principal_login')->middleware('check_principal_login');

Route::post('/registration-submit', 'CustomController@registration_submit')->name('registration_submit');
Route::post('/login-submit', 'CustomController@login_submit')->name('login_submit');

// muliti submit
Route::post('/login-student-submit', 'CustomController@login_student_submit')->name('login_student_submit');
Route::post('/login-teacher-submit', 'CustomController@login_teacher_submit')->name('login_teacher_submit');
Route::post('/login-principal-submit', 'CustomController@login_principal_submit')->name('login_principal_submit');


Route::get('/custom_logout', 'CustomController@custom_logout')->name('custom_logout');

// multi logout
Route::get('/custom_teacher_logout', 'CustomController@custom_teacher_logout')->name('custom_teacher_logout');
Route::get('/custom_student_logout', 'CustomController@custom_student_logout')->name('custom_student_logout');
Route::get('/custom_principal_logout', 'CustomController@custom_principal_logout')->name('custom_principal_logout');
