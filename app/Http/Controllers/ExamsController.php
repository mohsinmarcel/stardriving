<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamType;
use Illuminate\Http\Request;
use Auth;
class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasPermissionTo('exams-view'))
        {
        $exams = Exam::all();
        return view('exams.index',compact('exams'));
        }
        else{
        return abort(401);}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('exams-create'))
        {
            return abort(401);
        }
        $exam_types = ExamType::where('active',1)->get();
        return view('exams.create',compact('exam_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200|unique:exams,name',
            'total_questions' => 'required|numeric|digits_between:1,200',
            'marks_per_question' => 'required|numeric',
            'exam_type' => 'required',
        ]);
        Exam::create([
            'name' => $request->name,
            'total_questions' => $request->total_questions,
            'marks_per_question' => $request->marks_per_question,
            'exam_type_id' => $request->exam_type,
            'admin_id' => Auth::id(),
            'active'  => 1
        ]);
        return redirect()->route('exams.index')->with('success','Exam created successfully');
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
        if(!Auth::user()->hasPermissionTo('exams-edit'))
        {
            return abort(401);
        }
        $exam = Exam::findOrFail($id);
        $examTypes = ExamType::where('active',1)->get();
        return view('exams.edit',compact('exam','examTypes'));
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
            'name' => 'required|string|max:200|unique:exams,name,'.$id,
            'marks_per_question' => 'required|numeric',
            'exam_type' => 'required',
        ]);

        $exam = Exam::findOrFail($id);
        $exam->name = $request->name;
        $exam->marks_per_question = $request->marks_per_question;
        $exam->exam_type_id = $request->exam_type;
        $exam->active = $request->has('active')?1:0;
        $exam->save();
        return redirect()->route('exams.index')->with('success','Exam updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('exams-delete')){
            return abort(401);
        }
        $exam = Exam::findOrFail($id);
        if($exam->student_exams->count() > 0){
            return redirect()->route('exams.index')->with('error','Exam is not deleted. We have student exams exists.');
        }
        ExamQuestion::where('exam_id',$exam->id)->delete();
        $exam->delete();
        return redirect()->route('exams.index')->with('success','Exam deleted successfully.');
    }
}
