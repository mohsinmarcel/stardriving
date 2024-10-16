<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionOption;
use App\Models\ExamType;
use App\Models\Student;
use App\Models\StudentExam;
use App\Models\StudentExamQuestion;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Exception;
use Illuminate\Support\Facades\DB;

class StudentExamController extends Controller
{
    public function index($id){
        $exam_types = ExamType::where('active',1)->get();
        $student = Student::where('id',$id)->firstOrFail();
        return view('student-exams.index',compact('exam_types','student'));
    }

    public function examList($id,$student_id){
        $exams = Exam::where('exam_type_id',$id)->whereRaw("(select count(student_exams.exam_id) from student_exams where student_id ={$student_id} and student_exams.exam_id = exams.id) < 2 and active =1")->get();
        return view('student-exams.exams-list',compact('exams'));
    }
    public function examFetch($id){
        $exam = Exam::with(['exam_questions'])->findOrFail($id);
        $exam_options = ExamQuestionOption::where('active',1)->get();
        session()->put('exam',serialize($exam));
        return view('student-exams.exam-fetch',compact('exam','exam_options'));
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'exam_type' => 'required',
            'exam' => 'required',
            'exam_date' => 'required|date|before:tomorrow',
            'answers.*' => 'required_with:exam'
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
        }
        try{
            DB::beginTransaction();
            $exam = unserialize(session()->get('exam'));
            // session()->forget('exam');
            $examAttempt = StudentExam::where('exam_id',$request->exam)->where('student_id',$request->student_id)->count();
            $student_exam = StudentExam::create([
                'student_id' => $request->student_id,
                'exam_id' => $request->exam,
                'exam_date'=> $request->exam_date,
                'obtained_marks'=> 0,
                'total_marks'=> ($exam->total_questions * $exam->marks_per_question),
                'percentage' => 0,
                'admin_id' => Auth::id(),
                'attempts' => ++$examAttempt
            ]);
            $obtain_marks = 0;
            foreach ($request->answers as $key => $value) {
                $exam_question = ExamQuestion::where('question_no',$request->questions_no[$key])->where('exam_id',$exam->id)->firstOrFail();
                StudentExamQuestion::create([
                    'student_exam_id' => $student_exam->id,
                    'exam_question_id' => $exam_question->id,
                    'correct' => $exam_question->correct_answer == $value?1:0,
                    'answer' => $value,
                ]);
                $obtain_marks += $exam_question->correct_answer == $value?$exam->marks_per_question:0;
            }
            $student_exam->obtained_marks = $obtain_marks;
            $student_exam->percentage = round((($obtain_marks/$student_exam->total_marks)*100), 2);;
            $student_exam->save();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            return response()->json(['status'=>false,'error'=>"There's a error. Please try again"]);
        }
        return response()->json(['status'=>true,'message'=>"Stduent Exam added successfully."]);
    }

    public function edit($id){
        $student_exam = StudentExam::with('student_exam_questions','student_exam_questions.exam_question','exam','exam.exam_questions')->findOrFail($id);
        $exam_types = ExamType::where('active',1)->get();
        $exam_options = ExamQuestionOption::where('active',1)->get();
        $exams = Exam::where('exam_type_id',$student_exam->exam->exam_type_id)->get();
        return view('student-exams.edit',compact('exam_types','student_exam','exams','exam_options'));
    }

    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'exam_type' => 'required',
            'exam' => 'required',
            'exam_date' => 'required|date|before:tomorrow',
            'answers.*' => 'required_with:exam'
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
        }
        try{
            DB::beginTransaction();
            $student_exam = StudentExam::with('student_exam_questions')->findOrFail($request->id);
            StudentExamQuestion::where('student_exam_id',$student_exam->id)->delete();
            $exam = Exam::find($request->exam);
            $student_exam->update([
                'exam_id' => $request->exam,
                'exam_date'=> $request->exam_date,
                'obtained_marks'=> 0,
                'total_marks'=> ($exam->total_questions * $exam->marks_per_question),
                'percentage' => 0,
                'admin_id' => Auth::id(),
            ]);
            $obtain_marks = 0;
            foreach ($request->answers as $key => $value) {
                $exam_question = ExamQuestion::where('question_no',$request->questions_no[$key])->where('exam_id',$exam->id)->firstOrFail();
                StudentExamQuestion::create([
                    'student_exam_id' => $student_exam->id,
                    'exam_question_id' => $exam_question->id,
                    'correct' => $exam_question->correct_answer == $value?1:0,
                    'answer' => $value,
                ]);
                $obtain_marks += $exam_question->correct_answer == $value?$exam->marks_per_question:0;
            }
            $student_exam->obtained_marks = $obtain_marks;
            $student_exam->percentage = round((($obtain_marks/$student_exam->total_marks)*100), 2);;
            $student_exam->save();
            DB::commit();
        }catch(Exception $ex){
            throw $ex;
            DB::rollBack();
            return response()->json(['status'=>false,'error'=>"There's a error. Please try again"]);
        }
        return response()->json(['status'=>true,'message'=>"Stduent Exam added successfully."]);
    }

    public function show($student_exam_id){
        $student_exam = StudentExam::findOrFail($student_exam_id);
        return view('student-exams.show',compact('student_exam'));
    }

    public function destroy($id){
        $student_exam = StudentExam::findOrFail($id);
        StudentExamQuestion::where('student_exam_id',$student_exam->id)->delete();
        $student_exam->delete();
        return redirect()->back()->with(['success' => 'Student exam deleted successfully.']);
    }

}
