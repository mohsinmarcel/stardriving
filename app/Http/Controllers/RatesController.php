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
        $rates = Rate::groupBy('class_type_id')->whereNotNull('year')->get();
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
        // dd($request->all());
        $request->validate([
            'class_type_id.*' => 'required',
            'module.*' => 'required',
            'no_of_hours.*' => 'required',
            'hourly_rate.*' => 'required',
            'year' => 'required',
        ]);

        $classType = ClassType::create([
            'name' => $request->year,
            'active' => '1',
        ]);

        foreach($request->class_type_id as $key => $value)
        {

            Rate::create([
                'class_type_id' => $classType->id,
                'module' => $request->module[$key],
                'no_of_hours' => $request->no_of_hours[$key],
                'hourly_rate' => $request->hourly_rate[$key],
                'is_active' => 1,
                'year' => $value .'-'.$request->year,
            ]);
        }
        return redirect()->route('rates.index')->with('success', 'Rates Created successfully');
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
        // if(!Auth::user()->hasPermissionTo('rates-edit'))
        // {
        //     return abort(401);
        // }
        // // $rates = Rate::findOrFail($id);
        // $rates = Rate::where('year',$id)->get();
        // return view('rates.edit',\compact('rates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        dd($request->all());
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

    public function ratesEdits($year)
    {
        if(!Auth::user()->hasPermissionTo('rates-edit'))
        {
            return abort(401);
        }
        // $rates = Rate::findOrFail($id);
        $rates = Rate::where('class_type_id',$year)->get();
        return view('rates.edit',\compact('rates'));
    }

    public function showRates($year)
    {
        if(!Auth::user()->hasPermissionTo('rates-edit'))
        {
            return abort(401);
        }
        // $rates = Rate::findOrFail($id);
        $rates = Rate::where('class_type_id',$year)->get();
        return view('rates.show',\compact('rates'));
    }

    public function getRates($classTypeId)
    {
        $rates = Rate::where('class_type_id',$classTypeId)->get();
        return response()->json(['status' => 'success' , 'rates' => $rates ],200);
    }

    public function ratesUpdateProcess(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'class_type_id.*' => 'required',
            'module.*' => 'required',
            'no_of_hours.*' => 'required',
            'hourly_rate.*' => 'required',
            'year' => 'required',
        ]);

        $oldClassType = ClassType::where('name', 'LIKE', '%' . $request->old_year . '%')->get();
        if(!empty($oldClassType))
        {
            foreach($oldClassType as $classType) {
                Rate::where('class_type_id', $classType->id)->delete();
                $classType->delete();
            }
        }
        $classType = ClassType::create([
            'name' => $request->year,
            'active' => '1',
        ]);

        foreach($request->class_type_id as $key => $value)
        {

            Rate::create([
                'class_type_id' => $classType->id,
                'module' => $request->module[$key],
                'no_of_hours' => $request->no_of_hours[$key],
                'hourly_rate' => $request->hourly_rate[$key],
                'is_active' => 1,
                'year' => $value .'-'.$request->year,
            ]);
        }
        return redirect()->route('rates.index')->with('success', 'Rates Updated successfully');
    }
}
