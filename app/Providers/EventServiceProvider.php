<?php

namespace App\Providers;

use App\Events\TicketCreated;
use App\Listeners\ForwardTicket;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        TicketCreated::class => [ForwardTicket::class],
        Registered::class => [SendEmailVerificationNotification::class],
    ];
}
