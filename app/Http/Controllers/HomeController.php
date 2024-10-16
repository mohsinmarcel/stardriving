<?php

namespace App\Http\Controllers;

use App\Contracts\DashboardServiceContract;
use App\Models\ActivityLog;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ClassModule;

class HomeController extends Controller
{
    private $dashboard_service;
    public function __construct(DashboardServiceContract $service)
    {
        $this->dashboard_service = $service;
    }

    public function index(){
        $students = Student::Where('isextrastudent',false)->count();
        $extrastudents = Student::Where('isextrastudent',true)->count();
        $passed_students = Student::where('student_status','passed')->count();
        $remaining_students = Student::where('student_status','enrolled')->count();
        $activity = $this->dashboard_service->showLogActivities();
        $last_week_students = json_encode($this->dashboard_service->getLastWeekStudentsCount());
        $getTodayDrivingHours = $this->dashboard_service->getTodayDrivingHours();
        $getTotalDrivingHours = $this->dashboard_service->getTotalDrivingHours();
        $getRemainingDrivingHours = $this->dashboard_service->getRemainingDrivingHours();
        $getCompletedDrivingHours = $this->dashboard_service->getCompletedDrivingHours();
        $getTodayPaidAmount = $this->dashboard_service->getTodayPaidAmount();
        $getTotalPaidAmount = $this->dashboard_service->getTotalPaidAmount();
        $getTotalRemainingAmount = $this->dashboard_service->getTotalRemainingAmount();
        $studentTypeCount = Student::select('student_type', DB::raw('count(student_type) as student_count'))
        ->groupBy('student_type')
        ->get()->toJson();
        $student_status_count = Student::select('student_status', DB::raw('count(student_status) as student_count'))
        ->groupBy('student_status')
        ->get()->toJson();
        $getTwelveMonthPaymentHistory = json_encode($this->dashboard_service->getTwelveMonthPaymentHistory());
        $class_modules = ClassModule::where('active',1)->get()->toArray();

        // Retrieve upcoming Theory Exams
    $upcomingTheoryExams = Student::whereNotNull('theroy_exam_date')
    ->where('theroy_exam_date', '>', now())
    ->orderBy('theroy_exam_date')
    ->limit(5)
    ->get();

// Retrieve upcoming Knowledge Tests
$upcomingKnowledgeTests = Student::whereNotNull('knowledge_test_date')
    ->where('knowledge_test_date', '>', now())
    ->orderBy('knowledge_test_date')
    ->limit(5)
    ->get();


        return view('home.index',compact('getCompletedDrivingHours','extrastudents','last_week_students','getTodayDrivingHours','getTotalDrivingHours','getRemainingDrivingHours','students','getTodayPaidAmount','getTotalPaidAmount','getTotalRemainingAmount','getTwelveMonthPaymentHistory','getTwelveMonthPaymentHistory','studentTypeCount','activity','remaining_students','student_status_count','passed_students','class_modules', 'upcomingTheoryExams', 'upcomingKnowledgeTests'));
    }

    public function activityLogsView()
    {
        $activity = DB::table('activity_logs')
             ->select(DB::raw('message, created_at'))
             ->orderBy('created_at','DESC')
             ->paginate(15);
        return view('home.show',compact('activity'));
    }

    
public function getUpcomingExams(Request $request)
{
    $type = $request->get('type');
    $records = $request->get('records');

    if($type == "knowledge"){
        $upcomingExams = Student::whereNotNull("{$type}_test_date")
        ->where("{$type}_test_date", '>', now())
        ->orderBy("{$type}_test_date")
        ->limit($records)
        ->get(['first_name', 'last_name', "{$type}_test_date","{$type}_test_time"]);

    }else{
        $upcomingExams = Student::whereNotNull("{$type}_exam_date")
        ->where("{$type}_exam_date", '>', now())
        ->orderBy("{$type}_exam_date")
        ->limit($records)
        ->get(['first_name', 'last_name', "{$type}_exam_date"]);

    }

    
    
    return response()->json($upcomingExams);
}
}
