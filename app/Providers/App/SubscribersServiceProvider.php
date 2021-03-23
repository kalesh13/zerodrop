<?php

namespace App\Providers\App;

use Illuminate\Support\ServiceProvider;
use App\Services\Subscriber\SubscriberService;
use App\Repositories\Subscriber\SubscriberRepo;
use App\Repositories\Subscriber\ISubscriberRepo;
use Illuminate\Contracts\Support\DeferrableProvider;

class SubscribersServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application subscriber repository.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ISubscriberRepo::class, function ($app) {
            return new SubscriberRepo(function ($model) {
                return new SubscriberService($model);
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
        return [ISubscriberRepo::class];
    }
}