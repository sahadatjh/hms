<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\PreRegistration;
use App\Models\Package;
use App\Services\FileUploadService;

use function GuzzleHttp\Promise\all;

class PreRegistrationController extends Controller
{
    public function index()
    {
        $data['preRegisterHajjis']=PreRegistration::with('package','district')->orderBy('id','desc')->get();
        // dd($data['preRegisterHajjis']->toArray());
        return view('admin.hajjis.pre-registrations.index',$data);
    }

    public function create()
    {
        $data['packages']=Package::all();
        $data['districts']=District::all();
        return view('admin.hajjis.pre-registrations.create',$data);
    }

    public function store(FileUploadService $uploads, Request $request)
    {
        $request->validate(PreRegistration::$rules);

        $req = $request->all();
        $req['dob'] = date('yy-m-d',strtotime($req['dob']));
        
        if ($request->hasFile('photo')) {
            $fileName = $uploads->upload($request->file('photo'), $uploads::HAJJI_PHOTO);
            $req['photo'] = $fileName;
        }

        PreRegistration::create($req);
        return redirect()->back()->with('success','Hajji saved successfully!');
    }

    public function show(Package $package)
    {
        //
    }

    public function edit($id)
    {
        $data['hajji'] = PreRegistration::findOrFail($id);
        
        if ($data['hajji']) {
            $data['districts'] = District::all();
            $data['packages']  = Package::all();

            return view('admin.hajjis.pre-registrations.edit',$data);
        }
        return redirect()->back()->withErrors('Something is wrong!!!');
    }

    public function update(FileUploadService $uploads, Request $request)
    {
        $request->validate(PreRegistration::$rules);

        $req = $request->all();
        $hajji = PreRegistration::findOrFail($req['id']);
        
        if ($hajji) {
            $req['dob'] = date('yy-m-d',strtotime($req['dob']));
            
            if ($request->hasFile('photo')) {
                $fileName = $uploads->upload($request->file('photo'), $uploads::HAJJI_PHOTO);
                if( $hajji->photo ) $uploads->removeImg($hajji->photo, $uploads::HAJJI_PHOTO);
                $req['photo'] = $fileName;
            }
        }

        $hajji->update($req);
        return redirect()->route('admin.hajjis.pre_registrations.index')->with('success','Hajji updated successfully!');
    }

    public function delete(FileUploadService $uploads, $id)
    {
        $hajji = PreRegistration::findOrFail($id);
        if ($hajji) {
            if ($hajji->photo) {
                if( $hajji->photo ) $uploads->removeImg($hajji->photo, $uploads::HAJJI_PHOTO);
            }
            $hajji->delete();
            return redirect()->back()->withSuccess('Hajji deleted successfully!');
        }
        return redirect()->back()->withSuccess('Something is wrong!');
    }
}
