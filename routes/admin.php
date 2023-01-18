<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:admin'],'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login',[LoginController::class, 'create'])->name('login');
    Route::post('/login',[LoginController::class, 'login'])->name('login.store');
});

Route::group(['middleware' => ['auth:admin'],'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
});