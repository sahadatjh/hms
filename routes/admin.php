<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login',[LoginController::class, 'create'])->name('admin.login');
Route::post('/admin/login',[LoginController::class, 'login'])->name('admin.login.store');

Route::group(['middleware' => ['auth:admin'],'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard',function(){
        return view('admin.dashboard');
    })->name('dashboard');
});
