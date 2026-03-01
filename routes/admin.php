<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('home', [AdminController::class, 'index'])->name('adminHome');
});
