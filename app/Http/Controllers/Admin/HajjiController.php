<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Hajji;
use App\Models\Package;
use App\Models\District;
use Illuminate\Http\Request;
use App\Services\FileUploadService;

use App\Http\Controllers\Controller;
use function GuzzleHttp\Promise\all;

class HajjiController extends Controller
{
    public function index()
    {
        $data['preRegisterHajjis']=Hajji::where('status',1)->with('package','get_district')->orderBy('id','desc')->get();
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
        $req['dob'] = date('Y-m-d',strtotime($req['dob']));
        
        if ($request->hasFile('photo')) {
            $fileName = $uploads->upload($request->file('photo'), $uploads::HAJJI_PHOTO);
            $req['photo'] = $fileName;
        }

        Hajji::create($req);
        return redirect()->back()->with('success','Hajji saved successfully!');
    }

    public function show($id)
    {
        $data['hajji'] = Hajji::where('id',$id)->with('package','get_district')->first();
        // dd($data['hajji']->toArray());
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
        $req = $request->all();

        // $rules = Hajji::$rules;
        // $rules['name'] = $rules['name'] . ',id,' . $request->id;
        // $request->validate($rules);
        
        $request->validate(Hajji::$rules);

        $hajji = Hajji::findOrFail($req['id']);
        
        if ($hajji) {
            $req['dob'] = date('Y-m-d',strtotime($req['dob']));
            $req['district']=District::find($request->district_id)->name;
            
            if ($request->hasFile('photo')) {
                $fileName = $uploads->upload($request->file('photo'), $uploads::HAJJI_PHOTO);
                if( $hajji->photo ) $uploads->removeImg($hajji->photo, $uploads::HAJJI_PHOTO);
                $req['photo'] = $fileName;
            }
            
            if ($request->hasFile('passport_image')) {
                $fileName = $uploads->upload($request->file('passport_image'), $uploads::PASSPORT_IMAGE);
                if( $hajji->passport_image ) $uploads->removeImg($hajji->photo, $uploads::PASSPORT_IMAGE);
                $req['passport_image'] = $fileName;
            }
            
            if ($request->hasFile('visa_image')) {
                $fileName = $uploads->upload($request->file('visa_image'), $uploads::VISA_IMAGE);
                if( $hajji->visa_image ) $uploads->removeImg($hajji->visa_image, $uploads::VISA_IMAGE);
                $req['visa_image'] = $fileName;
            }
        }

        $hajji->update($req);

        if ($hajji->status == 1) {
            return redirect()->route('admin.hajjis.pre_registrations.index')->withSuccess('Hajji updated successfully!');
        }
        return redirect()->route('admin.hajjis.running_hajjis.index')->withSuccess('Hajji updated successfully!');

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

    public function getHajjiForPayment(Request $request)
    {
        $req = $request->all();

        $hajji = Hajji::with('payments');
        if(!is_null($req['ng'])) {
            $hajji =  $hajji->where('ng',$req['ng']);
        }
        if(!is_null($req['mobile'])) {
            $hajji =  $hajji->where('mobile',$req['mobile']);
        }
        if(!is_null($req['nid'])) {
            $hajji =  $hajji->where('nid',$req['nid']);
        }
        $hajji = $hajji->first();

        return response()->json(['success'=>true, 'data'=>$hajji]);
    }

    //running hujjis
    public function runningHajjis()
    {
        $data['runningHajjis']=Hajji::where('status',2)->with('package','get_district')->orderBy('id','desc')->get();

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

