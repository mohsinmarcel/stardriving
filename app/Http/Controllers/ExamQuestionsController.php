<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionOption;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $exam = Exam::where('id',$id)->firstOrFail();
        $exam_options = ExamQuestionOption::where('active',1)->get();
        $exam_questions = ExamQuestion::where('exam_id',$id)->get();
        return view('exam_questions.index',compact('exam','exam_options','exam_questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $request->validate([
            'answers.*' => 'required'
        ],[
            'answers.*.required' => 'The answer field is required.'
        ]);
        try
        {
            DB::beginTransaction();
            foreach ($request->answers as $key => $value) {
                ExamQuestion::updateOrCreate([
                    'exam_id' => $id,
                    'question_no' => $request->questions_no[$key],
                ],[
                    'correct_answer' => $value,
                ]);
            }
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            return abort(500);
        }
        return redirect()->route('exams.index')->with('success','Questions updated successfully');
        
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
        //
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
        //
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
