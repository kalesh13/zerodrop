<?php

namespace App\Providers\App;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Course\CourseRepo;
use App\Services\Courses\CourseService;
use App\Repositories\Course\ICourseRepo;
use Illuminate\Contracts\Support\DeferrableProvider;

class CoursesServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application course repository.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ICourseRepo::class, function ($app) {
            return new CourseRepo(function ($model) {
                return new CourseService($model);
            });
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ICourseRepo::class];
    }
}
