<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\StudentPayment;
use Illuminate\Support\Facades\Auth;

class StudentPaymentObserver
{
    /**
     * Handle the StudentPayment "created" event.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return void
     */
    public function created(StudentPayment $studentPayment)
    {
        ActivityLog::create([
            'message' => "Payment of $<b>{$studentPayment->amount}</b> for <b>{$studentPayment->payment_type->type}</b> received from <b>{$studentPayment->student->full_name}</b>."
        ]);
    }

    /**
     * Handle the StudentPayment "updated" event.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return void
     */
    public function updated(StudentPayment $studentPayment)
    {
        //
    }

    /**
     * Handle the StudentPayment "deleted" event.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return void
     */
    public function deleted(StudentPayment $studentPayment)
    {
        //
    }

    /**
     * Handle the StudentPayment "restored" event.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return void
     */
    public function restored(StudentPayment $studentPayment)
    {
        //
    }

    /**
     * Handle the StudentPayment "force deleted" event.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return void
     */
    public function forceDeleted(StudentPayment $studentPayment)
    {
        //
    }
}
