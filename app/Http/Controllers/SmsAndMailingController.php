<?php

namespace App\Http\Controllers;

use App\Contracts\ReportContract;
use App\Contracts\SmsServiceContract;
use Mail;
use App\Mail\StudentMail;
use App\Mail\AdditionalMail;
use App\Models\ActivityLog;
use App\Models\SettingDetail;
use App\Models\Student;
use App\Models\StudentEvaluation;
use App\Models\StudentExam;
use App\Models\Template;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Validator;
class SmsAndMailingController extends Controller
{
    private $sms_service;
    private $report_service;
    public function __construct(SmsServiceContract $sms,ReportContract $report_service){
        $this->sms_service = $sms;
        $this->report_service = $report_service;
    }

    public function sms($id){
        $student = Student::findOrFail($id);
        $template = Template::all();
        return view('sms_mail.sms',compact('id','student','template'));
    }
    public function smsPost(Request $request){
        $validator = Validator::make($request->all(),[
            'message' => 'required|max:10000|string',
        ]);
        $student = Student::find($request->student_id);
        if($student->phone_number_1 == null && $student->phone_number_2 == null){
            return response()->json(['status'=>false, 'error'=>["number" => "Student Number is not present. Please add number first."]]);
        }

        if($validator->fails()){
            return response()->json(['status'=>false, 'error'=>$validator->errors()->all()]);
        }
        try{
            $this->sms_service->sendSingleSms($request->phone_number, $request->message);

        }catch(\Throwable $ex){
            ActivityLog::create([
                'message' => "Sms Sending: <b>Failed</b>. Number: <b>{$student->phone_number_1}</b>. Error Message: Invalid phone number."
            ]);
            return response()->json(['status'=>false, 'error'=>["number" => "Invalid phone number."]]);
        }
        return response()->json(['status'=>true, 'message'=> "Sms sent sccessfully."]);
    }

    public function mail($id){
        $evaluations = StudentEvaluation::where('student_id',$id)->get();
        $exams = StudentExam::where('student_id',$id)->get();
        
        $template = Template::all();
        return view('sms_mail.mail',compact('id','evaluations','exams','template'));
    }

    public function mailPost(Request $request){
        
        $validator = Validator::make($request->all(),[
            'subject' => 'nullable|max:500|string',
            'message' => 'nullable|max:10000|string',
            'attachment' => 'nullable',
            'exam'=> 'required_if:attachment,==,exam',
            'evaluation'=> 'required_if:attachment,==,self_evaluation'
        ]);
        
        $student = Student::find($request->student_id);
        if($student->email == null){
            return response()->json(['status'=>false, 'error'=>["email" => "Student email is not present. Please add email first."]]);
        }

        if($validator->fails()){
            return response()->json(['status'=>false, 'error'=>$validator->errors()->all()]);
        }
        try{
            $mail_data =[
                "subject" => $request->subject ?? "(no subject)",
                "message" => $request->message
            ];
            $report = null;
            if ($request->attachment == 'additional_document') {
                // Handle the additional document attachment
                $additionalDocument = $request->file('additionalDocument');
                $report = $additionalDocument->storeAs('additional_documents', 'additional_document.' . $additionalDocument->getClientOriginalExtension(), 'public');
                Mail::to($student->email)->send(new AdditionalMail($mail_data,$report,$request->attachment));
            } else{
            switch ($request->attachment) {
                case 'contract':
                    $report = $this->report_service->contractReport($request->student_id)->Output("test.pdf", "S");
                    break;
                case 'medical':
                    $report = $this->report_service->studentMedical($request->student_id)->Output("test.pdf", "S");
                    break;
                case 'exam':
                    $report = $this->report_service->studentExam($request->exam)->Output("test.pdf", "S");
                    break;
                case 'exam_declaration':
                    $report = $this->report_service->examDeclaration($request->exam)->Output("test.pdf", "S");
                    break;
                case 'self_evaluation':
                    $report = $this->report_service->sessionEvaluation($request->evaluation)->Output("test.pdf", "S");
                    break;
                case 'final_certificate':
                    $report = $this->report_service->finalCertificate($request->student_id)->Output("test.pdf", "S");
                    break;
                case 'phase_one_certificate':
                    $report = $this->report_service->phaseOneCertificate($request->student_id)->Output("test.pdf", "S");
                    break;
                case 'invoice':
                    $report = $this->report_service->invoice($request->student_id)->Output("test.pdf", "S");
                    break;
                case 'attendance':
                    $report = $this->report_service->studentAttendance($request->student_id)->Output("test.pdf", "S");
                    break;
            }
        
            Mail::to($student->email)->send(new StudentMail($mail_data,$report,$request->attachment));
        }
        
        }catch(\Throwable $ex){
            throw $ex;
            ActivityLog::create([
                'message' => "Email Sending: <b>Failed</b>. Email: <b>{$student->email}</b>. Error Message: Invalid email address or mail server not responding."
            ]);
            return response()->json(['status'=>false, 'error'=>["email" => "Invalid email address or mail server not responding."]]);
        }
        return response()->json(['status'=>true, 'message'=> "Email sent sccessfully."]);
    }
}
