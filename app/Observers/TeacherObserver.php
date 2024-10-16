<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherObserver
{
    /**
     * Handle the Teacher "created" event.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return void
     */
    public function created(Teacher $teacher)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Teacher: <b>{$teacher->full_name}</b> created by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the Teacher "updated" event.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return void
     */
    public function updated(Teacher $teacher)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Teacher: <b>{$teacher->full_name}</b> updated by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the Teacher "deleted" event.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return void
     */
    public function deleted(Teacher $teacher)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Teacher: <b>{$teacher->full_name}</b> deleted by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the Teacher "restored" event.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return void
     */
    public function restored(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the Teacher "force deleted" event.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return void
     */
    public function forceDeleted(Teacher $teacher)
    {
        //
    }
}
