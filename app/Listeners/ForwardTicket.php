<?php

namespace App\Listeners;

use Swift_Mailer;
use Swift_Message;
use Swift_SendmailTransport;
use App\Contracts\ISettings;
use App\Events\TicketCreated;
use App\Repositories\Ticket\ITicketRepo;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForwardTicket implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Application settings.
     * 
     * @var \App\Contracts\ISettings
     */
    protected $settings;

    /**
     * Application ticket repository.
     * 
     * @var \App\Repositories\Ticket\ITicketRepo
     */
    protected $ticket_repo;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ISettings $settings, ITicketRepo $ticket_repo)
    {
        $this->settings = $settings;
        $this->ticket_repo = $ticket_repo;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TicketCreated $event)
    {
        if (!$this->settings->contactEmail()) {
            return;
        }
        $service = $this->ticket_repo->resolveService($event->ticket);

        $message = (new Swift_Message($service->subject()))
            ->setFrom([$service->email() => $service->name()])
            ->setTo([$this->settings->contactEmail()])
            ->setBody($service->message());

        return (new Swift_Mailer(new Swift_SendmailTransport()))->send($message);
    }
}
