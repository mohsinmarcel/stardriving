<?php

namespace App\Http\Controllers;

use App\Constants\DatabaseEnumConstants;
use App\Contracts\ReportContract;
use App\Models\SettingDetail;
use App\Models\Student;
use App\Models\StudentCourseDetail;
use App\Models\StudentDocument;
use App\Models\StudentEvaluation;
use App\Models\StudentEvaluationDetail;
use App\Models\StudentExam;
use App\Models\StudentExamQuestion;
use App\Models\StudentExtraCharges;
use App\Models\StudentPayment;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use DB;
use Auth;
class ReportsController extends Controller
{
    private $reportService;

    public function __construct(ReportContract $report_servcie){
        $this->reportService = $report_servcie;
    }

    public function create(){
        $students = Student::all();
        return view('reports.create',compact('students'));
    }

    public function store(Request $request){
        if($request->type == "student-medical"){
            $request->validate([
                "student" => 'required'
            ]);
            return \Redirect::route('reports.student-medical', [$request->student]);
          //  return redirect()->back()->with(['route' => route('reports.student-medical',$request->student)]);

        } else if($request->type == 'phaseone-certificate'){
            $request->validate([
                "student" => 'required'
            ]);
            return \Redirect::route('reports.phase-one-certificate', [$request->student]);
            //return redirect()->back()->with(['route' => route('reports.phase-one-certificate',$request->student)]);

        } else if($request->type == 'final-certificate'){
            $request->validate([
                "student" => 'required'
            ]);
            return \Redirect::route('reports.final-certificate', [$request->student]);
           // return redirect()->back()->with(['route' => route('reports.final-certificate',$request->student)]);

        } else if($request->type == 'student-contract'){
            $request->validate([
                "student" => 'required'
            ]);
            return \Redirect::route('reports.student-contract', [$request->student]);
           // return redirect()->back()->with(['route' => route('reports.student-contract',$request->student)]);

        } else if($request->type == 'exam'){
            $request->validate([
                "student" => 'required',
                'exam' => 'required',
                'report_type' => 'required'
            ]);
            if($request->report_type == 'exam-declaration'){
                return \Redirect::route('reports.exam-declaration', [$request->exam]);
               // return redirect()->back()->with(['route' => route('reports.exam-declaration',$request->exam)]);
            }else if($request->report_type == 'exam'){
                return \Redirect::route('reports.student-exam', [$request->exam]);
              //  return redirect()->back()->with(['route' => route('reports.student-exam',$request->exam)]);
            }
        }else if($request->type == 'attendance'){
            $request->validate([
                "student" => 'required'
            ]);
            return \Redirect::route('reports.student-attendance', [$request->student]);
            //return redirect()->back()->with(['route' => route('reports.student-attendance',$request->student)]);
        }else if($request->type == 'evaluation'){
            $request->validate([
                "student" => 'required',
                'session' => 'required'
            ]);
            return \Redirect::route('reports.session-evaluation', [$request->session]);
            //return redirect()->back()->with(['route' => route('reports.session-evaluation',$request->session)]);
        }

        
        // return view('reports.create');
    }
    
    public function getStudentExams($id){
        $student_exam = StudentExam::
        join('exams','student_exams.exam_id','exams.id')->
        where('student_id',$id)->select('student_exams.id','exams.name')->orderBy('exams.name')->get();
        return response()->json(['status'=>true,'data'=>$student_exam]);
    }

    public function getStudentEvaluation($id){
        $student_evaluation = StudentEvaluation::
        join('students','students.id','student_evaluations.student_id')->
        where('student_evaluations.student_id',$id)->select('student_evaluations.id','student_evaluations.session')->orderBy('student_evaluations.session')->get();
        return response()->json(['status'=>true,'data'=>$student_evaluation]);
    }

    public function sessionEvaluation($id){
        if(!Auth::user()->hasPermissionTo('report-evaluation')){
            return abort(401);
        }
        $mpdf = $this->reportService->sessionEvaluation($id);
        return  $mpdf->Output();
    }
    
    public function studentContract($id){
        if(!Auth::user()->hasPermissionTo('report-contract')){
            return abort(401);
        }
        $mpdf = $this->reportService->contractReport($id);
        return  $mpdf->Output();
    }

    public function studentExam($examId){
        if(!Auth::user()->hasPermissionTo('report-exam')){
            return abort(401);
        }
        $mpdf = $this->reportService->studentExam($examId);
        return  $mpdf->Output();
    }
    
    public function examDeclaration($id){
        if(!Auth::user()->hasPermissionTo('report-exam')){
            return abort(401);
        }
        $mpdf = $this->reportService->examDeclaration($id);
        return  $mpdf->Output();
    }

    public function studentMedical($id){
        if(!Auth::user()->hasPermissionTo('report-medical')){
            return abort(401);
        }
        $mpdf = $this->reportService->studentMedical($id);
        return  $mpdf->Output();
    }

    public function studentAttendance($id){
        if(!Auth::user()->hasPermissionTo('report-attendance')){
            return abort(401);
        }
        $mpdf = $this->reportService->studentAttendance($id);
        return  $mpdf->Output();
    }

    public function phaseOneCertificate($id){
        if(!Auth::user()->hasPermissionTo('report-phaseone-certificate')){
            return abort(401);
        }
        $mpdf = $this->reportService->phaseOneCertificate($id);
        return  $mpdf->Output();
    }

    public function finalCertificate($id){
        if(!Auth::user()->hasPermissionTo('report-final-certificate')){
            return abort(401);
        }
        $mpdf = $this->reportService->finalCertificate($id);
        return  $mpdf->Output();
    }

    public function invoice($id){
        if(!Auth::user()->hasPermissionTo('report-invoice')){
            return abort(401);
        }
        $mpdf = $this->reportService->invoice($id);
        return  $mpdf->Output();
    }
}
