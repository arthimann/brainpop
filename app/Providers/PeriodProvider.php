<?php

namespace App\Providers;

use App\School\Period\PeriodContract;
use App\School\Period\StudentService;
use App\School\Period\TeacherService;
use Illuminate\Support\ServiceProvider;

class PeriodProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PeriodContract::class, function () {
            if (request()->has('teacher')) {
                return new TeacherService;
            } else {
                return new StudentService;
            }
        });
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
