<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\ClassModule;
use Illuminate\Support\Facades\Auth;

class ClassModuleObserver
{
    /**
     * Handle the ClassModule "created" event.
     *
     * @param  \App\Models\ClassModule  $classModule
     * @return void
     */
    public function created(ClassModule $classModule)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
        'message' => "New <b>{$classModule->classType->name}</b> module: <b>{$classModule->name}</b> created by <b>{$auth_full_name->full_name}</b>."
    ]);
    }

    /**
     * Handle the ClassModule "updated" event.
     *
     * @param  \App\Models\ClassModule  $classModule
     * @return void
     */
    public function updated(ClassModule $classModule)
    {
        $auth_full_name = Auth::user();
        ActivityLog::create([
        'message' => "<b>{$classModule->classType->name}</b> module: <b>{$classModule->name}</b> updated by <b>{$auth_full_name->full_name}</b>. Old Name: <b>{$classModule->getOriginal('name')}</b>."
    ]);
    }

    /**
     * Handle the ClassModule "deleted" event.
     *
     * @param  \App\Models\ClassModule  $classModule
     * @return void
     */
    public function deleted(ClassModule $classModule)
    {
        //
    }

    /**
     * Handle the ClassModule "restored" event.
     *
     * @param  \App\Models\ClassModule  $classModule
     * @return void
     */
    public function restored(ClassModule $classModule)
    {
        //
    }

    /**
     * Handle the ClassModule "force deleted" event.
     *
     * @param  \App\Models\ClassModule  $classModule
     * @return void
     */
    public function forceDeleted(ClassModule $classModule)
    {
        //
    }
}
