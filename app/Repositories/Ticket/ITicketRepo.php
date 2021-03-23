<?php

namespace App\Repositories\Ticket;

use App\Repositories\ISimpleModelRepo;

interface ITicketRepo extends ISimpleModelRepo
{
    /**
     * Resolves a new service for the given model.
     * 
     * @param \Illuminate\Database\Eloquent\Model
     * @return \App\Services\Ticket\ITicketService
     */
    public function resolveService($model);
}
