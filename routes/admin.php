<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/login',function(){
    return 'admin login';
})->name('admin.login');

Route::group(['middleware' => ['auth:admin'],'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/hi',function(){
        return 'hi admin';
    });
});
