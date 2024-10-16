<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\ChargesType;
use Illuminate\Support\Facades\Auth;

class ChargesTypeObserver
{
    /**
     * Handle the ChargesType "created" event.
     *
     * @param  \App\Models\ChargesType  $chargesType
     * @return void
     */
    public function created(ChargesType $chargesType)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
        'message' => "New <b>{$chargesType->name}</b> Extra Charges Rate: $<b>{$chargesType->amount}</b> created by <b>{$auth_full_name->full_name}</b>."
    ]);
    }

    /**
     * Handle the ChargesType "updated" event.
     *
     * @param  \App\Models\ChargesType  $chargesType
     * @return void
     */
    public function updated(ChargesType $chargesType)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
        'message' => "New Extra Charges Rate: <b>{$chargesType->name}</b> rate updated from $<b>{$chargesType->getOriginal('amount')}</b> to $<b>{$chargesType->amount}</b> by <b>{$auth_full_name->full_name}</b>."
    ]);
    }

    /**
     * Handle the ChargesType "deleted" event.
     *
     * @param  \App\Models\ChargesType  $chargesType
     * @return void
     */
    public function deleted(ChargesType $chargesType)
    {
        //
    }

    /**
     * Handle the ChargesType "restored" event.
     *
     * @param  \App\Models\ChargesType  $chargesType
     * @return void
     */
    public function restored(ChargesType $chargesType)
    {
        //
    }

    /**
     * Handle the ChargesType "force deleted" event.
     *
     * @param  \App\Models\ChargesType  $chargesType
     * @return void
     */
    public function forceDeleted(ChargesType $chargesType)
    {
        //
    }
}
