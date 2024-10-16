<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class ExamObserver
{
    /**
     * Handle the Exam "created" event.
     *
     * @param  \App\Models\Exam  $exam
     * @return void
     */ 
    public function created(Exam $exam)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "New Exam: <b>{$exam->name}</b> created by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the Exam "updated" event.
     *
     * @param  \App\Models\Exam  $exam
     * @return void
     */
    public function updated(Exam $exam)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Exam: <b>{$exam->name}</b> updated by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the Exam "deleted" event.
     *
     * @param  \App\Models\Exam  $exam
     * @return void
     */
    public function deleted(Exam $exam)
    {
        //
    }

    /**
     * Handle the Exam "restored" event.
     *
     * @param  \App\Models\Exam  $exam
     * @return void
     */
    public function restored(Exam $exam)
    {
        //
    }

    /**
     * Handle the Exam "force deleted" event.
     *
     * @param  \App\Models\Exam  $exam
     * @return void
     */
    public function forceDeleted(Exam $exam)
    {
        //
    }
}
