<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\PreRegistrationController;

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

    Route::group(['prefix'=>'hajjis', 'as'=>'hajjis.'],function(){
        Route::group(['prefix'=>'pre-registrations', 'as'=>'pre_registrations.'],function(){
            Route::get('/',[PreRegistrationController::class,'index'])->name('index');
            Route::get('/create',[PreRegistrationController::class,'create'])->name('create');
            Route::post('/store',[PreRegistrationController::class,'store'])->name('store');
            Route::get('/edit/{id}',[PreRegistrationController::class,'edit'])->name('edit');
            Route::post('/update',[PreRegistrationController::class,'update'])->name('update');
            Route::get('/delete/{id}',[PreRegistrationController::class,'delete'])->name('delete');
        });
    });
});