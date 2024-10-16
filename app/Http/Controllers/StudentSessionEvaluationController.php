<?php

namespace App\Http\Controllers;

use App\Constants\DatabaseEnumConstants;
use App\Models\EvaluationType;
use App\Models\Student;
use App\Models\StudentEvaluation;
use App\Models\StudentEvaluationDetail;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Auth;
use Exception;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Storage;
use Validator;

class StudentSessionEvaluationController extends Controller
{
    private const INDEX_ROUTE = "student-session-evaluation.index";

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('session-evaluation-view')){
            return abort(401);
        }
        $student_evaluation = StudentEvaluation::with('student')->whereRaw("student_id NOT IN (select students.id from students where deleted_at IS NOT NULL)")->get();
        return view('student-session-evaluation.index',compact('student_evaluation'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('session-evaluation-create')){
            return abort(401);
        }
        $strengths = EvaluationType::where('type',DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH)->get();
        $weaknesses = EvaluationType::where('type',DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS)->get();
        $students = Student::select('id','student_id','first_name','last_name')->get();
        $teachers = Teacher::select('id','license_number','first_name','last_name')->get();
        // $students_sessions = StudentEvaluation::select('session')->where('student_id','')->get();
        return view('student-session-evaluation.create',compact(
            'strengths',
            'weaknesses',
            'students',
            'teachers'
        ));
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
            'student' => 'required',
            'teacher'=> 'required',
            'session' => 'required',
            'date' => 'required|date|before:tomorrow',
            'signature' => 'required',
            // 'learner_strengths'=>'required|array|min:1',
            // 'learner_strengths.*'=>'required|string',
            // 'learner_weaknesses'=>'required|array|min:1',
            // 'learner_weaknesses.*'=>'required|string',
            // 'instructor_strengths'=>'required|array|min:1',
            // 'instructor_strengths.*'=>'required|string',
            // 'instructor_weaknesses'=>'required|array|min:1',
            // 'instructor_weaknesses.*'=>'required|string',
        ]);
        $exists = StudentEvaluation::where(['student_id' => $request->student,'session' => $request->session])->exists();
        if($exists){
            return redirect()->back()->withInput()->withErrors(['session' => $request->session.' evaluation is already exists.']);
        }
        $this->addEvaluation($request);
        return redirect()->route(self::INDEX_ROUTE)->with('success','Session Evaluation created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('session-evaluation-show')){
            return abort(401);
        }
        $student_evaluation = StudentEvaluation::findOrFail($id);
        $leaner_strength = StudentEvaluationDetail::where([
            'student_evaluation_id' => $id,
            'type' => DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH,
            'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_STUDENT
        ])->select('name')->get()->toArray();
        $leaner_strength = array_map(fn($value) => $value['name'],$leaner_strength);

        $leaner_weakness = StudentEvaluationDetail::where([
            'student_evaluation_id' => $id,
            'type' => DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS,
            'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_STUDENT
        ])->select('name')->get()->toArray();
        $leaner_weakness = array_map(fn($value) => $value['name'],$leaner_weakness);

        $instructor_strength = StudentEvaluationDetail::where([
            'student_evaluation_id' => $id,
            'type' => DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH,
            'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_TEACHER
        ])->select('name')->get()->toArray();
        $instructor_strength = array_map(fn($value) => $value['name'],$instructor_strength);

        $instructor_weakness = StudentEvaluationDetail::where([
            'student_evaluation_id' => $id,
            'type' => DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS,
            'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_TEACHER
        ])->select('name')->get()->toArray();
        $instructor_weakness = array_map(fn($value) => $value['name'],$instructor_weakness);
        return view('student-session-evaluation.show',compact(
            'student_evaluation',
            'leaner_strength',
            'leaner_weakness',
            'instructor_strength',
            'instructor_weakness'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('session-evaluation-edit')){
            return abort(401);
        }
        $student_evaluation = StudentEvaluation::findOrFail($id);

        $leaner_strength = StudentEvaluationDetail::where([
            'student_evaluation_id' => $id,
            'type' => DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH,
            'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_STUDENT
        ])->select('name')->get()->toArray();
        $leaner_strength = array_map(fn($value) => $value['name'],$leaner_strength);

        $leaner_weakness = StudentEvaluationDetail::where([
            'student_evaluation_id' => $id,
            'type' => DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS,
            'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_STUDENT
        ])->select('name')->get()->toArray();
        $leaner_weakness = array_map(fn($value) => $value['name'],$leaner_weakness);

        $instructor_strength = StudentEvaluationDetail::where([
            'student_evaluation_id' => $id,
            'type' => DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH,
            'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_TEACHER
        ])->select('name')->get()->toArray();
        $instructor_strength = array_map(fn($value) => $value['name'],$instructor_strength);

        $instructor_weakness = StudentEvaluationDetail::where([
            'student_evaluation_id' => $id,
            'type' => DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS,
            'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_TEACHER
        ])->select('name')->get()->toArray();
        $instructor_weakness = array_map(fn($value) => $value['name'],$instructor_weakness);

        $strengths = EvaluationType::where('type',DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH)->get();
        $weaknesses = EvaluationType::where('type',DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS)->get();
        $students = Student::select('id','student_id','first_name','last_name')->get();
        $teachers = Teacher::select('id','license_number','first_name','last_name')->get();
        return view('student-session-evaluation.edit',compact(
            'strengths',
            'weaknesses',
            'students',
            'teachers',
            'student_evaluation',
            'leaner_strength',
            'leaner_weakness',
            'instructor_strength',
            'instructor_weakness'
        ));
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
            'student' => 'required',
            'teacher'=> 'required',
            'session' => 'required',
            'date' => 'required|date|before:tomorrow',
            // 'learner_strengths'=>'required|array|min:1',
            // 'learner_strengths.*'=>'required|string',
            // 'learner_weaknesses'=>'required|array|min:1',
            // 'learner_weaknesses.*'=>'required|string',
            // 'instructor_strengths'=>'required|array|min:1',
            // 'instructor_strengths.*'=>'required|string',
            // 'instructor_weaknesses'=>'required|array|min:1',
            // 'instructor_weaknesses.*'=>'required|string',
        ]);
        $this->updateEvaluation($request,$id);
        return redirect()->route(self::INDEX_ROUTE)->with('success','Session Evaluation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(!Auth::user()->hasPermissionTo('session-evaluation-delete')){
            return abort(401);
        }
        $student_evaluation = StudentEvaluation::findOrFail($id);
        StudentEvaluationDetail::where('student_evaluation_id',$id)->delete();
        $student_evaluation->delete();
        return redirect()->back()->with('success','Session Evaluation deleted successfully');
    }

    public function createModel()
    {
        $strengths = EvaluationType::where('type',DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH)->get();
        $weaknesses = EvaluationType::where('type',DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS)->get();
        $teachers = Teacher::select('id','license_number','first_name','last_name')->get();
        // $students = Student::findOrFail($id);
        return view('student-session-evaluation.create-modal',compact('teachers','weaknesses','strengths'));
    }
    public function storeModel(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'student' => 'required',
            'teacher'=> 'required',
            'session' => 'required',
            'date' => 'required|date|before:tomorrow',
            'signature' => 'required',
            // 'learner_strengths'=>'required|array|min:1',
            // 'learner_strengths.*'=>'required|string',
            // 'learner_weaknesses'=>'required|array|min:1',
            // 'learner_weaknesses.*'=>'required|string',
            // 'instructor_strengths'=>'required|array|min:1',
            // 'instructor_strengths.*'=>'required|string',
            // 'instructor_weaknesses'=>'required|array|min:1',
            // 'instructor_weaknesses.*'=>'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
        }
        $exists = StudentEvaluation::where(['student_id' => $request->student,'session' => $request->session])->exists();
        if($exists){
            return response()->json(['status'=>false,'error'=>['session' => $request->session.' evaluation is already exists.']]);
        }
        $this->addEvaluation($request);
        return response()->json(['status'=>true,'message'=>"Self Evaluation Added Successfully"]);
    }
    public function editModel($id){
        if(!Auth::user()->hasPermissionTo('session-evaluation-edit')){
            return abort(401);
        }
        $student_evaluation = StudentEvaluation::findOrFail($id);

        $leaner_strength = StudentEvaluationDetail::where([
            'student_evaluation_id' => $id,
            'type' => DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH,
            'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_STUDENT
        ])->select('name')->get()->toArray();
        $leaner_strength = array_map(fn($value) => $value['name'],$leaner_strength);

        $leaner_weakness = StudentEvaluationDetail::where([
            'student_evaluation_id' => $id,
            'type' => DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS,
            'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_STUDENT
        ])->select('name')->get()->toArray();
        $leaner_weakness = array_map(fn($value) => $value['name'],$leaner_weakness);

        $instructor_strength = StudentEvaluationDetail::where([
            'student_evaluation_id' => $id,
            'type' => DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH,
            'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_TEACHER
        ])->select('name')->get()->toArray();
        $instructor_strength = array_map(fn($value) => $value['name'],$instructor_strength);

        $instructor_weakness = StudentEvaluationDetail::where([
            'student_evaluation_id' => $id,
            'type' => DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS,
            'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_TEACHER
        ])->select('name')->get()->toArray();
        $instructor_weakness = array_map(fn($value) => $value['name'],$instructor_weakness);

        $strengths = EvaluationType::where('type',DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH)->get();
        $weaknesses = EvaluationType::where('type',DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS)->get();
        $teachers = Teacher::select('id','license_number','first_name','last_name')->get();
        return view('student-session-evaluation.edit-modal',compact(
            'strengths',
            'weaknesses',
            'teachers',
            'student_evaluation',
            'leaner_strength',
            'leaner_weakness',
            'instructor_strength',
            'instructor_weakness'
        ));
    }
    public function updateModel(Request $request){
        $validator = Validator::make($request->all(),[
            'student' => 'required',
            'teacher'=> 'required',
            'session' => 'required',
            'date' => 'required|date|before:tomorrow',
            // 'learner_strengths'=>'required|array|min:1',
            // 'learner_strengths.*'=>'required|string',
            // 'learner_weaknesses'=>'required|array|min:1',
            // 'learner_weaknesses.*'=>'required|string',
            // 'instructor_strengths'=>'required|array|min:1',
            // 'instructor_strengths.*'=>'required|string',
            // 'instructor_weaknesses'=>'required|array|min:1',
            // 'instructor_weaknesses.*'=>'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
        }
        $exists = StudentEvaluation::where(['student_id' => $request->student,'session' => $request->session])->where('id','!=',$request->evaluation_id)->exists();
        if($exists){
            return response()->json(['status'=>false,'error'=>['session' => $request->session.' evaluation is already exists.']]);
        }
        $this->updateEvaluation($request,$request->evaluation_id);
        return response()->json(['status'=>true,'message'=>"Self Evaluation Updated Successfully"]);
    }
    protected function addEvaluation(Request $request){
        try{
            DB::beginTransaction();
            $file_name = 'signatures/'. uniqid().''.uniqid().'.png';
            $file_stream = Image::make(file_get_contents($request->signature))->stream();
            Storage::disk('local')->put($file_name,$file_stream);
            $student_evaluation = StudentEvaluation::create([
                'student_id' => $request->student,
                'teacher_id' => $request->teacher,
                'session' => $request->session,
                'date' => $request->date,
                'student_signature' => $file_name,
                'admin_id' => Auth::id(),
            ]);
            $learner_strengths = $request->learner_strengths ?? [];
            $learner_weaknesses = $request->learner_weaknesses ?? [];
            $instructor_strengths = $request->instructor_strengths ?? [];
            $instructor_weaknesses = $request->instructor_weaknesses ?? [];

            foreach($learner_strengths as $key => $item){
                StudentEvaluationDetail::create([
                    'name' => $item,
                    'student_evaluation_id' => $student_evaluation->id,
                    'type' => DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH,
                    'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_STUDENT
                ]);
            }
            foreach($learner_weaknesses as $key => $item){
                StudentEvaluationDetail::create([
                    'name' => $item,
                    'student_evaluation_id' => $student_evaluation->id,
                    'type' => DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS,
                    'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_STUDENT
                ]);
            }
            foreach($instructor_strengths as $key => $item){
                StudentEvaluationDetail::create([
                    'name' => $item,
                    'student_evaluation_id' => $student_evaluation->id,
                    'type' => DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH,
                    'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_TEACHER
                ]);
            }
            foreach($instructor_weaknesses as $key => $item){
                StudentEvaluationDetail::create([
                    'name' => $item,
                    'student_evaluation_id' => $student_evaluation->id,
                    'type' => DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS,
                    'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_TEACHER
                ]);
            }
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            return abort(500);
            // throw $ex;
        }
    }
    protected function updateEvaluation(Request $request,$id){
        try{
            DB::beginTransaction();
            $student_evaluation = StudentEvaluation::findOrFail($id);
            if($request->has('signature')){

                $file_name = 'signatures/'. uniqid().''.uniqid().'.png';
                $file_stream = Image::make(file_get_contents($request->signature))->stream();
                Storage::disk('local')->put($file_name,$file_stream);

                Storage::delete($student_evaluation->student_signature);
                $student_evaluation->student_signature = $file_name;
                $student_evaluation->save();
            }

            $student_evaluation->update([
                'student_id' => $request->student,
                'teacher_id' => $request->teacher,
                'session' => $request->session,
                'date' => $request->date,
            ]);

            $learner_strengths = $request->learner_strengths ?? [];
            $learner_weaknesses = $request->learner_weaknesses ?? [];
            $instructor_strengths = $request->instructor_strengths ?? [];
            $instructor_weaknesses = $request->instructor_weaknesses ?? [];

            StudentEvaluationDetail::where('student_evaluation_id',$student_evaluation->id)->delete();

            foreach($learner_strengths as $key => $item){
                StudentEvaluationDetail::create([
                    'name' => $item,
                    'student_evaluation_id' => $student_evaluation->id,
                    'type' => DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH,
                    'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_STUDENT
                ]);
            }
            foreach($learner_weaknesses as $key => $item){
                StudentEvaluationDetail::create([
                    'name' => $item,
                    'student_evaluation_id' => $student_evaluation->id,
                    'type' => DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS,
                    'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_STUDENT
                ]);
            }
            foreach($instructor_strengths as $key => $item){
                StudentEvaluationDetail::create([
                    'name' => $item,
                    'student_evaluation_id' => $student_evaluation->id,
                    'type' => DatabaseEnumConstants::EVALUATION_TYPE_STRENGTH,
                    'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_TEACHER
                ]);
            }
            foreach($instructor_weaknesses as $key => $item){
                StudentEvaluationDetail::create([
                    'name' => $item,
                    'student_evaluation_id' => $student_evaluation->id,
                    'type' => DatabaseEnumConstants::EVALUATION_TYPE_WEAKNESS,
                    'evaluation_by' => DatabaseEnumConstants::EVALUATION_BY_TEACHER
                ]);
            }
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            return abort(500);
            // throw $ex;
        }
    }
}
