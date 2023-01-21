<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PreRegistration;

class PreRegistrationController extends Controller
{
    public function index()
    {
        $data['preRegisterHajjis']=PreRegistration::with('package')->get();
        // dd($data['preRegisterHajjis']->toArray());
        return view('admin.hajjis.pre-registrations.index',$data);
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
