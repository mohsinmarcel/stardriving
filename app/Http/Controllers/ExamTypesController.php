<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use Illuminate\Http\Request;
use Validator;
use Auth;

class ExamTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('exam-types-view'))
        {
            return abort(401);
        }
        $examType = ExamType::all();
        return view('exam-types.index',compact('examType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('exam-types-create'))
        {
            return abort(401);
        }
        $examType = ExamType::all();
        return view('exam-types.create',compact('examType'));
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
            'name' => 'required|max:200|unique:exam_types,name'
        ]);

        if($validator->fails()){
            return response()->json(['status'=>false, 'error'=>$validator->errors()->all()]);
        }
        $inputs = [
            'name' => $request->name,
            'active' => $request->has('active')?1:0
        ];
        ExamType::create($inputs);
        return response()->json(['status'=>true, 'success'=>"Exam Type added sccessfully"]);
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
        if(!Auth::user()->hasPermissionTo('exam-types-edit'))
        {
            return abort(401);
        }
        $examType = ExamType::findOrFail($id);
        return view('exam-types.edit',compact('examType'));
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
            'name' => 'required|max:200|unique:exam_types,name,'.$request->id
        ]);

        $examType = ExamType::findOrFail($request->id);
        $examType->name = $request->name;
        $examType->active = $request->has('active')?1:0;
        $examType->save();
        return response()->json(['status'=>true, 'success'=>"Exam Type updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('exam-types-delete')){
            return abort(401);
        }
        $examType = ExamType::findOrFail($id);
        if($examType->exams->count() > 0){
            return redirect()->route('exam-types.index')->with('error','Exam Type is not deleted. We have exams in this type.');
        }
        $examType->delete();
        return redirect()->route('exam-types.index')->with('success','Exam Type deleted successfully.');
    }
}
