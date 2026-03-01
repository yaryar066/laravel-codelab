<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SocialLoginController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;


Route::get('/admin/panel', function () {
    return "Welcome Admin!";
})->middleware('admin');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/', function () {
    return redirect()->route('login');
});


require_once __DIR__.'/admin.php';
require_once __DIR__.'/user.php';





Route::get('/user/home', [UserController::class, 'userHome'])
    ->name('userHome');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('adminHome');


//Route::get('/', function () {
    //return view('welcome');
//});
Route::redirect('/', 'login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//google login & github login
Route::get('/auth/{provider}/redirect',[SocialLoginController::class,'redirect'])->name('socialLogin');

Route::get('auth/{provider}/callback',[SocialLoginController::class,'callback'])->name('socialCallback');
