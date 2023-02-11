<?php

use App\Http\Controllers\ManageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/manage', [ManageController::class,'index'])->name('manage');
Route::get('/cache-clear', [ManageController::class,'cacheClear'])->name('cache.clear');
Route::get('/optimize-clear', [ManageController::class,'optimizeClear'])->name('optimize.clear');
Route::get('/migrate', [ManageController::class,'migrate'])->name('migrate');
Route::get('/migrate-seed', [ManageController::class,'migrateSeed'])->name('migrate.seed');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
