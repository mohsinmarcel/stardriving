<?php

namespace App\Http\Controllers;

use App\Models\EvaluationType;
use Illuminate\Http\Request;
use Validator;
use Auth;

class EvaluationTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('evaluation-type-view')){
            return abort(401);
        }
        $evaluationType = EvaluationType::all();
        return view('evaluation-types.index',compact('evaluationType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('evaluation-type-create')){
            return abort(401);
        }
        $evaluationType = EvaluationType::all();
        return view('evaluation-types.create',compact('evaluationType'));
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
            'name' => 'required|max:200|unique:evaluation_types,name',
            'type' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['status'=>false, 'error'=>$validator->errors()->all()]);
        }
        $inputs = [
            'name' => $request->name,
            'type' => $request->type,
            'admin_id' => Auth::id()
        ];
        EvaluationType::create($inputs);
        return response()->json(['status'=>true, 'success'=>"Evaluation Criteria added sccessfully"]);
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
        if(!Auth::user()->hasPermissionTo('evaluation-type-edit')){
            return abort(401);
        }
        $evaluationType = EvaluationType::findOrFail($id);
        return view('evaluation-types.edit',compact('evaluationType'));
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
            'name' => 'required|max:200|unique:evaluation_types,name,'.$request->id,
        ]);

        $evaluationType = EvaluationType::findOrFail($request->id);
        $evaluationType->name = $request->name;
        $evaluationType->type = $request->type;
        $evaluationType->active = $request->has('active')?1:0;
        $evaluationType->save();
        return response()->json(['status'=>true, 'success'=>"Evaluation Criteria updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('evaluation-type-delete'))
        {
            return abort(401);
        }
        $evaluation_types = EvaluationType::findOrFail($id);
        $evaluation_types->delete();
        return redirect()->route('evaluation-types.index')->with('success','Evaluation Type deleted successfully.');
    }
}
