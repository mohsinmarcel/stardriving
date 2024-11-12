<?php

namespace App\Http\Controllers;

use App\Contracts\GoogleCalendarContract;
use App\Models\ClassModule;
use App\Models\ClassType;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StudentAttendanceDetail;
use App\Models\StudentCourseDetail;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Validator;

class StudentAttendancesController extends Controller
{
    private $google_calendar_service;
    public function __construct(GoogleCalendarContract $google_calendar){
        $this->google_calendar_service = $google_calendar;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('attendance-view'))
        {
            return abort(401);
        }
        $student_attendances = StudentAttendance::with('class_type','class_module','teacher')->get();
        $class_modules = ClassModule::where('active',1)->get()->toArray();
        return view('student-attendance.index',compact('student_attendances','class_modules'));
    }

    // Attendance Create from student profile page
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('attendance-create'))
        {
            return abort(401);
        }
        $students = Student::all();
        $class_types = ClassType::where('active',1)->get();

        $teachers = Teacher::where('is_active',1)->get();
        return view('student-attendance.create',compact(
            'students',
            'class_types',
            'teachers',
        ));
    }
    // Attendance Create from Attendance page
    public function createAttendance($id)
    {
        if(!Auth::user()->hasPermissionTo('attendance-create'))
        {
            return abort(401);
        }
        $student = Student::findOrFail($id);
        $class_types = ClassType::where('active',1)->whereIn('id',[1,2])->get();

        $teachers = Teacher::where('is_active',1)->get();


        return view('student-attendance.student-attendance',compact(
            'student',
            'class_types',
            'teachers',
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
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'class_type'=> "required",
            'attendance_date'=> "required|date",
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'student'=> "required",
            'teacher'=> "required",
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
        }
        $student_hours = StudentCourseDetail::
        selectRaw('student_course_details.student_id,sum(student_course_details.practical_credit_hours) as total_practical_hours ,sum(student_course_details.practical_credit_hours) - (select (count(*))  from  student_attendances JOIN student_attendance_details ON student_attendances.id=student_attendance_details.student_attendance_id where class_type_id = 2 and student_attendance_details.student_id = student_course_details.student_id) as remaining_driving_hours,sum(student_course_details.theoretical_credit_hours) as total_theoritical_hours,sum(student_course_details.theoretical_credit_hours) - (select (count(*)*2) from  student_attendances JOIN student_attendance_details ON student_attendances.id=student_attendance_details.student_attendance_id where class_type_id = 1 and student_attendance_details.student_id = student_course_details.student_id) as remaining_theoritical_hours')
        ->whereIn('student_course_details.student_id', $request->student)
        ->groupBy('student_course_details.student_id')->get();
        $course_complete_students = [];
        foreach ($student_hours as $key => $value) {
            if($request->class_type == 1){

                if($value->remaining_theoritical_hours < 2){
                    array_push($course_complete_students,$value->student_id);
                }
            }elseif($request->class_type == 2){
                if($value->remaining_driving_hours < 1){
                    array_push($course_complete_students,$value->student_id);
                }
            }
        }
        // echo count($course_complete_students);die;
        if(count($course_complete_students) > 0){
            $std_roll_no = Student::select('student_id')->whereIn('id',$course_complete_students)->get()->map(function($item){
                return $item->student_id;
            });
            return response()->json(['status'=>false,'error'=>['student' => '['.implode(', ',$std_roll_no->toArray()).'] not have enough hours to mark this attendance.']]);
        }

        if($request->class_type == 2 && count($request->student) > 1){
            return response()->json(['status'=>false,'error'=>['student' => 'Select only one student for practical attendance.']]);
        }

        $attendanceExist = StudentAttendance::join('student_attendance_details','student_attendances.id','student_attendance_details.student_attendance_id')->join('students','students.id','student_attendance_details.student_id')->whereIn('student_attendance_details.student_id',$request->student)
        ->where('class_type_id' , $request->class_type)
        ->where('class_module_id' , $request->class_module)
        ->select('students.student_id')->get();

        if($attendanceExist->count() > 0){
            $students_roll_nos = implode(', ',$attendanceExist->pluck('student_id')->toArray());
            return response()->json(['status'=>false,'error'=>['student' => '['.$students_roll_nos.']'.' Student\'s Attendance already marked.']]);
        }
        try
        {
            $class_module = ClassModule::find($request->class_module);
            $teacher = Teacher::find($request->teacher);
            $start_date = Carbon::parse($request->attendance_date.' '.$request->start_time);
            $end_date = Carbon::parse($request->attendance_date.' '.$request->end_time);

            $student_attendance = StudentAttendance::create([
                'class_type_id' => $request->class_type,
                'class_module_id' => $request->class_module,
                'teacher_id' => $request->teacher,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'attendance_date' => $request->attendance_date,
                'mark_by' => Auth::id(),
                // 'event_id' => $request->category ?? null
            ]);
            foreach ($request->student as $value) {
                $student_attendance->student_attendance_details()->save(
                    new StudentAttendanceDetail([
                        'student_id' => $value
                    ])
                );
            }
            $name = '';
            $description = '';
            if($request->class_type == 1){
                $name = "Theoretical Module: ".$class_module->name;
                $description = "Teacher Name: ".$teacher->full_name;
            }else if($request->class_type == 2){
                $student = Student::find($request->student[0]);
                $name = "Driving ".$class_module->name.' "'.$student->student_id.' / '.$student->full_name.'"';
                $description = "Teacher Name: ".$teacher->full_name;
            }
            try{
            $event =  $this->google_calendar_service->addNewEvent($name,$description,$start_date,$end_date);
            $student_attendance->event_id = $event;
            }catch(Exception $e){
                // dd($e);
            }
            $student_attendance->save();
        }catch(Exception $e){
            //  throw $e;
            // dd($e);
            return response()->json([
                'status'=>false,
                'error'=> ['student' => 'Something went wrong. Please try again.']
            ],422);
        }
        return response()->json(['status'=>true,'success'=>"Student Attendance added successfully."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student_attendance = StudentAttendance::with('class_type','class_module','teacher','student_attendance_details','student_attendance_details.student')->findOrFail($id);
        return view('student-attendance.show',compact('student_attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student_attendance = StudentAttendance::with('student_attendance_details')->findOrFail($id);
        $student_marked = $student_attendance->student_attendance_details->pluck('student_id')->toArray();
        $class_types = ClassType::where('active',1)->get();
        $teachers = Teacher::where('is_active',1)->get();
        $modules = ClassModule::where('class_type_id',$student_attendance->class_type_id)->where('active',1)->get();
        $students = Student::all();
        return view('student-attendance.edit',compact('student_attendance','class_types','teachers','modules','students','student_marked'));
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
        $student_attendance = StudentAttendance::with('student_attendance_details')->findOrFail($id);
        $validator = Validator::make($request->all(),[
            'class_type'=> "required",
            'attendance_date'=> "required|date",
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'teacher'=> "required",
            'student'=> "required",
        ]);

        if($validator->fails()){
            return response()->json(['status'=>false,'error'=>$validator->errors()->all()]);
        }
        $student_marked = $student_attendance->student_attendance_details->pluck('student_id')->toArray();

        $attendanceExist = StudentAttendance::join('student_attendance_details','student_attendances.id','student_attendance_details.student_attendance_id')->join('students','students.id','student_attendance_details.student_id')->whereIn('student_attendance_details.student_id',$student_marked)
        ->where('class_type_id' , $request->class_type)
        ->where('class_module_id' , $request->class_module)
        ->where('student_attendances.id','<>',$student_attendance->id)
        ->select('students.student_id')->get();

        if($attendanceExist->count() > 0){
            $students_roll_nos = implode(', ',$attendanceExist->pluck('student_id')->toArray());
            return response()->json(['status'=>false,'error'=>['student' => 'Student "'.$students_roll_nos.'" Attendance already marked.']]);
        }
        try{
            $class_module = ClassModule::find($request->class_module);
            $teacher = Teacher::find($request->teacher);
            $start_date = Carbon::parse($request->attendance_date.' '.$request->start_time);
            $end_date = Carbon::parse($request->attendance_date.' '.$request->end_time);



            $student_attendance->class_type_id = $request->class_type;
            $student_attendance->class_module_id = $request->class_module;
            $student_attendance->teacher_id = $request->teacher;
            $student_attendance->start_time = $request->start_time;
            $student_attendance->end_time = $request->end_time;
            $student_attendance->attendance_date = $request->attendance_date;
            $student_attendance->mark_by = Auth::id();
            $student_attendance->event_id = $request->category ?? null;
            $student_attendance->save();
            StudentAttendanceDetail::where('student_attendance_id',$student_attendance->id)->delete();
            foreach ($request->student as $value) {
                $student_attendance->student_attendance_details()->save(
                    new StudentAttendanceDetail([
                        'student_id' => $value
                    ])
                );
            }

            $name = '';
            $description = '';
            if($request->class_type == 1){
                $name = "Theoretical Module: ".$class_module->name;
                $description = "Teacher Name: ".$teacher->full_name;

            }else if($request->class_type == 2){
                $student = Student::find($request->student[0]);
                $name = "Driving ".$class_module->name.' "'.$student->student_id.' / '.$student->full_name.'"';
                $description = "Teacher Name: ".$teacher->full_name;
            }

            $eventId = $this->google_calendar_service->updateEventById([
                'name' => $name,
                'description' => $description,
                'startDateTime' => $start_date,
                'endDateTime' => $end_date,
            ],$student_attendance->event_id);

            $student_attendance->event_id = $eventId;
            $student_attendance->save();

        }catch(Exception $ex){
            throw $ex;
            return response()->json([
                'status'=>false,
                'error'=> ['student' => 'Something went wrong. Please try again.']
            ]);
        }
        return response()->json(['status'=>true,'success'=>"Student Attendance updated successfully."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('attendance-delete'))
        {
            return abort(401);
        }
        $attendance = StudentAttendance::findOrFail($id);
        if($attendance->event_id!=null){
            $this->google_calendar_service->deleteEventById($attendance->event_id);
            }
        StudentAttendanceDetail::where('student_attendance_id',$attendance->id)->delete();
        $attendance->delete();
        return redirect()->back()->with('success','Attendance deleted successfully');
    }
}
