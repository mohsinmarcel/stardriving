<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function created(Student $student)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Student: <b>{$student->full_name}</b> created by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the Student "updated" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function updated(Student $student)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Student: <b>{$student->full_name}</b> updated by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the Student "deleted" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function deleted(Student $student)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Student: <b>{$student->full_name}</b> deleted by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the Student "restored" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function restored(Student $student)
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    public function forceDeleted(Student $student)
    {
        //
    }
}
