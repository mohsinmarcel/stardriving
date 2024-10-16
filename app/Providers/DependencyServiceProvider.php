<?php

namespace App\Providers;

use App\Contracts\DashboardServiceContract;
use App\Contracts\GoogleCalendarContract;
use App\Contracts\ReportContract;
use App\Contracts\SmsServiceContract;
use App\Services\DashboardService;
use App\Services\GoogleCalendarService;
use App\Services\ReportService;
use App\Services\SmsService;
use Illuminate\Support\ServiceProvider;

class DependencyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DashboardServiceContract::class, DashboardService::class);
        $this->app->bind(SmsServiceContract::class, SmsService::class);
        $this->app->bind(ReportContract::class, ReportService::class);
        $this->app->bind(GoogleCalendarContract::class, GoogleCalendarService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
