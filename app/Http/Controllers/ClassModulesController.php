<?php

namespace App\Http\Controllers;

use App\Models\ClassModule;
use App\Models\ClassType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use Validator;

class ClassModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('class-modules-view'))
        {
            return abort(401);  
        }
        $classType = ClassType::all();
        $classModule = ClassModule::all();
        return view('class-modules.index',compact('classModule','classType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('class-modules-create'))
        {
            return abort(401);
        }
        $classType = ClassType::all();
        $classModule = ClassModule::all();
        return view('class-modules.create',compact('classModule','classType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'class_type_id' => 'required',
            'name' => [
                'required', 'max:255',
                Rule::unique('class_modules')->where(function ($query) use($request) {
                    return $query->where('class_type_id', $request->class_type_id);
                }),
            ],
        ]);   

        if($validator->fails()){
            return response()->json(['status'=>false, 'error'=>$validator->errors()->all()]);
        }
        $inputs = [
            'class_type_id' => $request->class_type_id,
            'name' => $request->name
        ];
        ClassModule::create($inputs);
        return response()->json(['status'=>true, 'success'=>"Class Module added successfully."]);
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
        if(!Auth::user()->hasPermissionTo('class-modules-edit'))
        {
            return abort(401);
        }
        $classModule = ClassModule::findOrFail($id);
        return View('class-modules.edit',compact('classModule'));
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
            'class_type_id' => 'required',
            // 'name' => [
            //     'required', 'max:255',
            //     Rule::unique('class_modules')->ignore($id)->where(function ($query) use($request) {
            //         return $query->where('class_type_id', $request->class_type_id);
            //     }),
            // ],
        ]);

        $classModule = ClassModule::findOrFail($request->id);
        $classModule->class_type_id = $request->class_type_id;
        $classModule->name = $request->name;
        $classModule->active = $request->has('active')?1:0;
        $classModule->save();
        return response()->json(['status'=>true, 'success'=>"Class Module updated successfully."]);
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
