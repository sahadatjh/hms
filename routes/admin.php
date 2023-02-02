<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\HajjiController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;

Route::redirect('/admin', '/admin/login');

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
        
        Route::group(['prefix'=>'agents', 'as'=>'agents.'],function(){
            Route::get('/',[AgentController::class,'index'])->name('index');
            Route::get('/edit/{id}',[AgentController::class,'edit'])->name('edit');
            Route::post('/store',[AgentController::class,'store'])->name('store');
            Route::post('/update',[AgentController::class,'update'])->name('update');
            Route::get('/delete/{id}',[AgentController::class,'delete'])->name('delete');
        });

    });

    Route::group(['prefix'=>'hajjis', 'as'=>'hajjis.'],function(){
        Route::group(['prefix'=>'pre-registrations', 'as'=>'pre_registrations.'],function(){
            Route::controller(HajjiController::class)->group(function(){
                Route::get('/','index')->name('index');
                Route::get('/create','create')->name('create');
                Route::post('/store','store')->name('store');
                Route::get('/show/{id}','show')->name('show');
                Route::get('/edit/{id}','edit')->name('edit');
                Route::post('/update','update')->name('update');
                Route::get('/delete/{id}','delete')->name('delete');

                Route::get('/migrate/{id}','moveToRunning')->name('migrate');
            });
        });

        Route::post('/get-hajji-for-payment',[HajjiController::class,'getHajjiForPayment']);
        Route::post('/get-payments-by-hajji',[PaymentController::class,'getPaymentsByHajji']);

        Route::group(['prefix'=>'running-hajjis', 'as'=>'running_hajjis.'],function(){
            Route::controller(HajjiController::class)->group(function(){
                Route::get('/','runningHajjis')->name('index');
                Route::get('/back/{id}','backToPreRegister')->name('back_preregister');
            });
        });
    });

    Route::group(['prefix'=>'payments', 'as'=>'payments.'],function(){
        Route::controller(PaymentController::class)->group(function(){
            Route::get('/','index')->name('index');
            Route::post('/store','store')->name('store');
            Route::get('/due-list','dueList')->name('duelist');
        });
    });
});