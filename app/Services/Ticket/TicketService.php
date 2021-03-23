<?php

namespace App\Services\Ticket;

use App\Models\Ticket;
use Illuminate\Support\Collection;
use App\Services\SimpleModelService;

/**
 * Magic methods and properties
 * 
 * @property \App\Models\Ticket $ticket
 * @method \App\Models\Ticket ticket()
 * @method string name()
 * @method string email()
 * @method string subject()
 * @method string message()
 */
class TicketService extends SimpleModelService implements ITicketService
{
    /**
     * Checks if the given data passes the underlying model validations.
     * 
     * @param \Illuminate\Support\Collection $data
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return $this
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(Collection $data, $model = null)
    {
        validator($data->all(), Ticket::validationRules($model))->validate();

        return $this;
    }

    /**
     * Updates the model with the given data and saves it on the database.
     * 
     * @param \Illuminate\Support\Collection $data
     * @return bool
     */
    public function saveData(Collection $data)
    {
        $this->ticket->email = $data->get('email');
        $this->ticket->subject = $data->get('subject');
        $this->ticket->name = $data->get('name');
        $this->ticket->phone = $data->get('phone');
        $this->ticket->message = $data->get('message');

        return $this->ticket->save();
    }
}
