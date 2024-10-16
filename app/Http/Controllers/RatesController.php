<?php

namespace App\Http\Controllers;

use App\Models\ClassType;
use Illuminate\Http\Request;
use App\Models\Rate;
use Auth;

class RatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(!Auth::user()->hasPermissionTo('rates-view'))
        {
            return abort(401);
        }
        $rates = Rate::all();
        return view('rates.index',\compact('rates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rates = Rate::all();
        $classType = ClassType::all();
        return view('rates.create',\compact('classType','rates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('rates-edit'))
        {
            return abort(401);
        }
        $rates = Rate::findOrFail($id);
        return view('rates.edit',\compact('rates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'module' => 'required',
            'no_of_hours' => 'required',
            'hourly_rate' => 'required'
        ]);

        $rates = Rate::findOrFail($id);
        $rates->module = $request->module;
        $rates->no_of_hours = $request->no_of_hours;
        $rates->hourly_rate = $request->hourly_rate;
        $rates->save();
        return redirect()->route('rates.index')->with('success','Rates updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
