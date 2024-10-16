<?php

namespace App\Providers;

use App\Models\ChargesType;
use App\Models\ClassModule;
use App\Models\Exam;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StudentDocument;
use App\Models\StudentEvaluation;
use App\Models\StudentExam;
use App\Models\StudentPayment;
use App\Models\Teacher;
use App\Observers\ChargesTypeObserver;
use App\Observers\ClassModuleObserver;
use App\Observers\ExamObserver;
use App\Observers\StudentAttendanceObserver;
use App\Observers\StudentDocumentObserver;
use App\Observers\StudentEvaluationObserver;
use App\Observers\StudentExamObserver;
use App\Observers\StudentObserver;
use App\Observers\StudentPaymentObserver;
use App\Observers\TeacherObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Student::observe(StudentObserver::class);
        Teacher::observe(TeacherObserver::class);
        StudentPayment::observe(StudentPaymentObserver::class);
        Exam::observe(ExamObserver::class);
        StudentEvaluation::observe(StudentEvaluationObserver::class);
        ChargesType::observe(ChargesTypeObserver::class);
        StudentExam::observe(StudentExamObserver::class);
        ClassModule::observe(ClassModuleObserver::class);
        StudentAttendance::observe(StudentAttendanceObserver::class);
        StudentDocument::observe(StudentDocumentObserver::class);
    }
}
