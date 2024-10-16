<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\StudentAttendance;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceObserver
{
    /**
     * Handle the StudentAttendance "created" event.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return void
     */
    public function created(StudentAttendance $studentAttendance)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Attendance of <b>{$studentAttendance->class_type->name}</b> class for <b>{$studentAttendance->class_module->name}</b> created by <b>{$auth_full_name->full_name}</b>."
        ]);
        //<b>{$studentAttendance->student->full_name}</b>'s
    }

    /**
     * Handle the StudentAttendance "updated" event.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return void
     */
    public function updated(StudentAttendance $studentAttendance)
    {
        
    }

    /**
     * Handle the StudentAttendance "deleted" event.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return void
     */
    public function deleted(StudentAttendance $studentAttendance)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Attendance of <b>{$studentAttendance->class_type->name}</b> class for <b>{$studentAttendance->class_module->name}</b> deleted by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the StudentAttendance "restored" event.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return void
     */
    public function restored(StudentAttendance $studentAttendance)
    {
        //
    }

    /**
     * Handle the StudentAttendance "force deleted" event.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return void
     */
    public function forceDeleted(StudentAttendance $studentAttendance)
    {
        //
    }
}
