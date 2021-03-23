<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use App\Events\TicketCreated;
use App\Traits\HasSearchAndFilter;
use Illuminate\Support\Collection;
use App\Repositories\SimpleModelRepo;

class TicketRepo extends SimpleModelRepo implements ITicketRepo
{
    use HasSearchAndFilter;

    /**
     * Creates a new ticket from the given data, stores it into the database and returns
     * the same.
     * 
     * Creating a new ticket will emit an event `TicketCreated` that care of notifying the 
     * administrators/support teams. 
     * 
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $result = parent::create($data);

        event(new TicketCreated($result));

        return $result;
    }

    /**
     * Returns paginated list of all the tickets created in the app. Presence of search/filter
     * query on the list will return only the matching results.
     * 
     * @param \Illuminate\Support\Collection $request
     * @param int $per_page
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function all(Collection $request, $per_page = 15)
    {
        return Ticket::where(
            function ($query) use ($request) {
                $this->setSearchColumn('email');
                $this->setSearchOnQuery($query, $request);

                $this->setFilterColumn('status');
                $this->setFilterOnQuery($query, $request);
            }
        )->paginate($per_page);
    }

    /**
     * Resolves a new service for the given model.
     * 
     * @param \Illuminate\Database\Eloquent\Model
     * @return \App\Services\Ticket\ITicketService
     */
    public function resolveService($model)
    {
        return parent::resolveService($model);
    }

    /**
     * Returns the model on which this service operates.
     * 
     * @return class
     */
    public function modelClass()
    {
        return Ticket::class;
    }
}
