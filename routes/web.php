<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    return view('auth.login', ['url' => 'admin']);
});


Auth::routes(['register' => false]);

Route::get('/login/admin', [LoginController::class,'showAdminLoginForm']);
Route::get('/login/employee', [LoginController::class,'showEmployeeLoginForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/login/employee', [LoginController::class,'employeeLogin']);

//Route::view('/home', 'home')->middleware('auth');
//Route::view('/admin', 'admin');
Route::view('/employee', 'employee');
Route::get('/admin', [HomeController::class, 'admin']);

Route::get('auth/google', [GoogleController::class, 'signInwithGoogle']);
Route::get('callback/google', [GoogleController::class, 'callbackToGoogle']);


Route::prefix('admin')->middleware(['auth'])->group(function (){


    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //profile
    Route::get('/profile',[ProfileController::class,'index'])->name('admin.profile');
    Route::get('/profile/edit/{id}',[ProfileController::class,'edit'])->name('admin.profile.edit');
    Route::post('/profile/update/{id}',[ProfileController::class,'update'])->name('admin.profile.update');
    Route::post('/profile/change_password/{id}',[ProfileController::class,'changePassword'])->name('admin.profile.changepassword');

    //user
    Route::get('/user/list',[UserController::class,'index'])->name('admin.user.index');
    Route::get('/user/create',[UserController::class,'create'])->name('admin.user.create');
    Route::post('/user/store',[UserController::class,'store'])->name('admin.user.store');
    Route::get('/user/edit/{id}',[UserController::class,'edit'])->name('admin.user.edit');
    Route::post('/user/update/{id}',[UserController::class,'update'])->name('admin.user.update');
    Route::post('/user/delete/{id}',[UserController::class,'destroy'])->name('admin.user.destroy');

    Route::resource('employee',EmployeeController::class);

    Route::get('/attendance-list',[AttendanceController::class,'index'])->name('admin.attendance.index');
    Route::get('/attendance-create',[AttendanceController::class,'create'])->name('admin.attendance.create');
    Route::post('/attendance',[AttendanceController::class,'store'])->name('admin.attendance.store');



});
