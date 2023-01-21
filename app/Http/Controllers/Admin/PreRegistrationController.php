<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreRegistrationController extends Controller
{
    public function index()
    {
        return view('admin.hajjis.pre-registrations.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Package::create($request->all());
        // return redirect()->back()->withSuccess('Package created successfully!');
    }

    public function show(Package $package)
    {
        //
    }

    public function edit(Package $package)
    {
        //
    }

    public function update(Request $request)
    {
        // Package::find($request->id)->update($request->all());
        // return redirect()->back()->withSuccess('Package updated successfully!');
    }

    public function delete($id)
    {
        // Package::find($id)->delete();
        // return redirect()->back()->withSuccess('Package deleted successfully!');
    }
}
