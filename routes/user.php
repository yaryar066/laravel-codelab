<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::group(['prefix' => 'user', 'middleware' => 'user'], function() {
    Route::get('home', [AdminController::class, 'index'])->name('userHome');
});
