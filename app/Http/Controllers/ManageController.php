<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ManageController extends Controller
{
    public function index()
    {
        return view('manage');
    }

    public function cacheClear()
    {
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('route:cache');
        Artisan::call('view:clear');
        Artisan::call('view:cache');
        return redirect()->back()->withSuccess("Cache Route View cleared...");
    }
    
    public function optimizeClear()
    {
        Artisan::call('optimize:clear');
        return redirect()->back()->withSuccess("Optimize cleared...");
        
    }
    
    public function migrate()
    {
        Artisan::call('migrate');
        return redirect()->back()->withSuccess("migrated successfully!");
    }
    
    public function migrateSeed()
    {
        Artisan::call('migrate:fresh --seed');
        return redirect()->back()->withSuccess("migration & seed successfully!");
    }
}
