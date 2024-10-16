<?php

namespace App\Http\Controllers;
use App\Models\StudentAttendance;
use App\Models\Event;

use Illuminate\Http\Request;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
       
            $data = StudentAttendance::with('class_type', 'class_module', 'teacher', 'student_attendance_details.student')
            ->where('attendance_date', '>=', $request->start)
            ->where('attendance_date', '<=', $request->end)
            ->get();

            
        
        // Transform attendance records to Event instances
        $events = $data->map(function ($attendance) {

            $studentNames = $attendance->student_attendance_details->pluck('student.full_name')->implode(', ');
            $attendanceTitle = $attendance->class_type->name;

            return new Event([
                'id' => $attendance->id,  // Adjust as needed
                'title' => "$studentNames - $attendanceTitle",
                'start' => $attendance->attendance_date,
                'end' => $attendance->attendance_date,
                // Add more fields as needed
            ]);
        });
        return response()->json($events);
        }
  
        return view('fullcalender');
    }
}
