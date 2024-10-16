<?php

namespace App\Http\Controllers;

use App\Models\StudentNote;
use Illuminate\Http\Request;
use App\Models\Student;
use Validator;
use Auth;

class StudentNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
    }

    public function studentNoteCreate($id)
    {
        $student = Student::findOrFail($id);
        $studentNote = StudentNote::all();
        return view('student-notes.create',compact('studentNote','student'));
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
            'description' => 'required|max:500'
        ]);

        if($validator->fails()){
            return response()->json(['status'=>false, 'error'=>$validator->errors()->all()]);
        }
        $inputs = [
            'student_id' => $request->student_id,
            'description' => $request->description,
            'admin_id' => Auth::id()
        ];

        StudentNote::create($inputs);
        return response()->json(['status'=>true, 'success'=>"Student Note added successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentNote = StudentNote::findOrfail($id);
        return view('student-notes.show',compact('studentNote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $studentNote = StudentNote::findOrfail($id);
        return view('student-notes.edit',compact('studentNote'));
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
            'description' => 'required|max:500'
        ]);

        $studentNote = StudentNote::findOrFail($request->id);
        $studentNote->description = $request->description;
        $studentNote->save();
        return response()->json(['status'=>true, 'success'=>"Student Note updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::first();
        $studentNote = StudentNote::findOrFail($id);
        $studentNote->delete();
        return redirect()->route('students.show',$student->id)->with('success','Student Note deleted successfully');
        // return response()->json(['status'=>true, 'success'=>"Student Note deleted successfully"]);
    }
}
