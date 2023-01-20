<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PackageController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:admin'],'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login',[LoginController::class, 'create'])->name('login');
    Route::post('/login',[LoginController::class, 'login'])->name('login.store');
});

Route::group(['middleware' => ['auth:admin'],'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::post('logout',[LoginController::class,'logout'])->name('logout');

    Route::group(['prefix'=>'masterdata', 'as'=>'masterdata.'],function(){
        Route::group(['prefix'=>'packages', 'as'=>'packages.'],function(){
            Route::get('/',[PackageController::class,'index'])->name('index');
            Route::post('/store',[PackageController::class,'store'])->name('store');
            Route::post('/update',[PackageController::class,'update'])->name('update');
            Route::get('/delete/{id}',[PackageController::class,'delete'])->name('delete');
        });
    });
});