<?php

namespace App\Http\Controllers\Tickets;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Ticket\ITicketRepo;

class TicketController extends Controller
{
    /**
     * Application support ticket repo.
     * 
     * @var \App\Repositories\Ticket\ITicketRepo
     */
    protected $ticket_repo;

    /**
     * Controller takes care of all the support ticket related API endpoints.
     * 
     * @param \App\Repositories\Ticket\ITicketRepo $settings
     */
    public function __construct(ITicketRepo $ticket_repo)
    {
        $this->ticket_repo = $ticket_repo;
    }

    /**
     * Creates a new support ticket on the database when a contact form is submitted.
     * This will forward the contact form details to the administrator email.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $this->ticket_repo->create($request->all());

        return back();
    }
}
