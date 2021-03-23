<?php

namespace App\Services\Ticket;

use App\Services\ISimpleModelService;

/**
 * Magic methods and properties
 * 
 * @method \App\Models\Ticket ticket()
 * @method string name()
 * @method string email()
 * @method string subject()
 * @method string message()
 */
interface ITicketService extends ISimpleModelService
{
}
