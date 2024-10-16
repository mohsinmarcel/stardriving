<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\StudentDocument;
use Illuminate\Support\Facades\Auth;

class StudentDocumentObserver
{
    /**
     * Handle the StudentDocument "created" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function created(StudentDocument $studentDocument)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Student Document: <b>{$studentDocument->documentType->name}</b> added by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the StudentDocument "updated" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function updated(StudentDocument $studentDocument)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Student Document: <b>{$studentDocument->documentType->name}</b> updated by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the StudentDocument "deleted" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function deleted(StudentDocument $studentDocument)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
            'message' => "Student Document: <b>{$studentDocument->documentType->name}</b> deleted by <b>{$auth_full_name->full_name}</b>."
        ]);
    }

    /**
     * Handle the StudentDocument "restored" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function restored(StudentDocument $studentDocument)
    {
        //
    }

    /**
     * Handle the StudentDocument "force deleted" event.
     *
     * @param  \App\Models\StudentDocument  $studentDocument
     * @return void
     */
    public function forceDeleted(StudentDocument $studentDocument)
    {
        //
    }
}
