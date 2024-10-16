<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\StudentExam;
use Illuminate\Support\Facades\Auth;

class StudentExamObserver
{
    public $afterCommit = true;

    /**
     * Handle the StudentExam "created" event.
     *
     * @param  \App\Models\StudentExam  $studentExam
     * @return void
     */
    public function created(StudentExam $studentExam)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
        'message' => "<b>{$studentExam->exam->name}</b> result of <b>{$studentExam->student->full_name}</b> uploaded by <b>{$auth_full_name->full_name}</b>. <b>{$studentExam->obtained_marks}</b> out of <b>{$studentExam->total_marks}</b>. Percentage: <b>{$studentExam->percentage}%</b>."
    ]);
    }

    /**
     * Handle the StudentExam "updated" event.
     *
     * @param  \App\Models\StudentExam  $studentExam
     * @return void
     */
    public function updated(StudentExam $studentExam)
    {
        //
    }

    /**
     * Handle the StudentExam "deleted" event.
     *
     * @param  \App\Models\StudentExam  $studentExam
     * @return void
     */
    public function deleted(StudentExam $studentExam)
    {
        //
    }

    /**
     * Handle the StudentExam "restored" event.
     *
     * @param  \App\Models\StudentExam  $studentExam
     * @return void
     */
    public function restored(StudentExam $studentExam)
    {
        //
    }

    /**
     * Handle the StudentExam "force deleted" event.
     *
     * @param  \App\Models\StudentExam  $studentExam
     * @return void
     */
    public function forceDeleted(StudentExam $studentExam)
    {
        //
    }
}
