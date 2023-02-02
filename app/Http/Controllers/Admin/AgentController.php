<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;

class AgentController extends Controller
{
    public function index()
    {
        $data['agents'] = Agent::with('getDistrict')->get();
        $data['districts'] = District::all();
        return view('admin.masterdata.agents.index',$data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|unique:agents|max:255',
            'mobile'      => 'required',
            'district_id' => 'required',
            'address'     => 'required|max:255',
        ]);

        Agent::create($request->all());
        return redirect()->back()->withSuccess('Agent created successfully!');
    }

    public function edit($id)
    {
        $data['agent'] = Agent::find($id)->with('getDistrict')->first();
        return view('admin.masterdata.agents.edit',$data)->render();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|max:255||unique:agents',
            'mobile'      => 'required',
            'district_id' => 'required|numeric',
            'address'     => 'required|max:255',
        ]);

        $agent = Agent::find($request->all());
        return redirect()->back()->withSuccess('Agent updated successfully!');
    }

    public function delete($id)
    {
        Agent::find($id)->delete();
        return redirect()->back()->withSuccess('Agent deleted successfully!');
    }
}
