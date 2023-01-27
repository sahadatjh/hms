<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Hajji;
use App\Models\Package;
use App\Services\FileUploadService;

use function GuzzleHttp\Promise\all;

class HajjiController extends Controller
{
    public function index()
    {
        $data['preRegisterHajjis']=Hajji::where('status',1)->with('package','district')->orderBy('id','desc')->get();
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
        $request->validate(Hajji::$rules);

        $req = $request->all();
        $req['district']=District::find($request->district_id)->name;
        $req['dob'] = date('yy-m-d',strtotime($req['dob']));
        
        if ($request->hasFile('photo')) {
            $fileName = $uploads->upload($request->file('photo'), $uploads::HAJJI_PHOTO);
            $req['photo'] = $fileName;
        }

        Hajji::create($req);
        return redirect()->back()->with('success','Hajji saved successfully!');
    }

    public function show($id)
    {
        $data['hajji'] = Hajji::find($id);
        return view('admin.hajjis.pre-registrations.show',$data);
    }

    public function edit($id)
    {
        $data['hajji'] = Hajji::findOrFail($id);
        
        if ($data['hajji']) {
            $data['districts'] = District::all();
            $data['packages']  = Package::all();

            return view('admin.hajjis.pre-registrations.edit',$data);
        }
        return redirect()->back()->withErrors('Something is wrong!!!');
    }

    public function update(FileUploadService $uploads, Request $request)
    {
        $request->validate(Hajji::$rules);

        $req = $request->all();
        $hajji = Hajji::findOrFail($req['id']);
        
        if ($hajji) {
            $req['dob'] = date('yy-m-d',strtotime($req['dob']));
            $req['district']=District::find($request->district_id)->name;
            
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
        $hajji = Hajji::findOrFail($id);
        if ($hajji) {
            if ($hajji->photo) {
                if( $hajji->photo ) $uploads->removeImg($hajji->photo, $uploads::HAJJI_PHOTO);
            }
            $hajji->delete();
            return redirect()->back()->withSuccess('Hajji deleted successfully!');
        }
        return redirect()->back()->withSuccess('Something is wrong!');
    }

    public function moveToRunning($id)
    {
        $hajji = Hajji::findOrFail($id);
        if ($hajji){
            $hajji->fill(['status' => 2])->save();
        }
        else return redirect()->back()->withErrors('Something is wrong!');
        return redirect()->back()->withSuccess($hajji->name.', Move to running successfully!');
    }

    //running hujjis
    public function runningHajjis()
    {
        $data['runningHajjis']=Hajji::where('status',2)->with('package','district')->orderBy('id','desc')->get();

        return view('admin.hajjis.running-hajjis.index',$data);   
    }

    public function backToPreRegister($id)
    {
        $hajji = Hajji::findOrFail($id);
        if ($hajji){
            $hajji->fill(['status' => 1])->save();
        }
        else return redirect()->back()->withErrors('Something is wrong!');
        return redirect()->back()->withSuccess($hajji->name.', Move to pre-register successfully!');
    }
}

