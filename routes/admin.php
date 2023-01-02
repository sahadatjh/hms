<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login',[LoginController::class, 'create'])->name('admin.login');

Route::group(['middleware' => ['auth:admin'],'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/hi',function(){
        return 'hi admin';
    });
});
