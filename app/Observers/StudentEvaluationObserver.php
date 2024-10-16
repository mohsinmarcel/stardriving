<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\StudentEvaluation;
use Illuminate\Support\Facades\Auth;

class StudentEvaluationObserver
{
    /**
     * Handle the StudentEvaluation "created" event.
     *
     * @param  \App\Models\StudentEvaluation  $studentEvaluation
     * @return void
     */
    public function created(StudentEvaluation $studentEvaluation)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Student: <b>{$studentEvaluation->student->full_name}</b>'s evaluation of <b>{$studentEvaluation->session}</b> created by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the StudentEvaluation "updated" event.
     *
     * @param  \App\Models\StudentEvaluation  $studentEvaluation
     * @return void
     */
    public function updated(StudentEvaluation $studentEvaluation)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Student: <b>{$studentEvaluation->student->full_name}</b>'s evaluation of <b>{$studentEvaluation->session}</b> updated by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the StudentEvaluation "deleted" event.
     *
     * @param  \App\Models\StudentEvaluation  $studentEvaluation
     * @return void
     */
    public function deleted(StudentEvaluation $studentEvaluation)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Student: <b>{$studentEvaluation->student->full_name}</b>'s evaluation of <b>{$studentEvaluation->session}</b> deleted by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the StudentEvaluation "restored" event.
     *
     * @param  \App\Models\StudentEvaluation  $studentEvaluation
     * @return void
     */
    public function restored(StudentEvaluation $studentEvaluation)
    {
        //
    }

    /**
     * Handle the StudentEvaluation "force deleted" event.
     *
     * @param  \App\Models\StudentEvaluation  $studentEvaluation
     * @return void
     */
    public function forceDeleted(StudentEvaluation $studentEvaluation)
    {
        //
    }
}
