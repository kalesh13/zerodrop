<?php

namespace App\Providers\App;

use App\Services\Ticket\TicketService;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Ticket\TicketRepo;
use App\Repositories\Ticket\ITicketRepo;
use Illuminate\Contracts\Support\DeferrableProvider;

class TicketsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application support ticket repository.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ITicketRepo::class, function ($app) {
            return new TicketRepo(function ($model) {
                return new TicketService($model);
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
        return [ITicketRepo::class];
    }
}