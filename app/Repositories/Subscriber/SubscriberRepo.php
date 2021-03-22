<?php

namespace App\Repositories\Subscriber;

use App\Models\Subscriber;
use Illuminate\Support\Collection;
use App\Traits\HasSearchAndFilter;
use App\Repositories\SimpleModelRepo;

class SubscriberRepo extends SimpleModelRepo implements ISubscriberRepo
{
    use HasSearchAndFilter;

    /**
     * Activates the subscription status of an existing subscriber. If no subscriber exists, a new
     * one is created. Returns the updated/created subscriber details.
     * 
     * @param string $email
     * @return \App\Models\Subscriber
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function subscribe($email)
    {
        return $this->runOnSubscriber($email, function ($subscriber) use ($email) {
            if (is_null($subscriber)) {
                return $this->create(['email' => $email, 'subscription' => true]);
            }
            return $this->update($subscriber, ['email' => $email, 'subscription' => true]);
        });
    }

    /**
     * Unsubscribes an existing subscriber from the database. Returns the updated subscriber details.
     * 
     * @param string $email
     * @return \App\Models\Subscriber|true
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function unsubscribe($email)
    {
        return $this->runOnSubscriber($email, function ($subscriber) use ($email) {
            if (is_null($subscriber)) {
                return true;
            }
            return $this->update($subscriber, ['email' => $email, 'subscription' => false]);
        });
    }

    /**
     * Executes the given `callback` function with the subscriber model for the given `email`
     * as the parameter.
     * 
     * @param string $email
     * @param callable $callback
     * @return mixed
     */
    protected function runOnSubscriber($email, callable $callback)
    {
        if (!is_callable($callback)) {
            return null;
        }
        return $callback(Subscriber::where('email', $email)->first());
    }

    /**
     * Returns paginated coupon list with coupon usage field.
     * 
     * @param \Illuminate\Support\Collection $request
     * @param int $per_page
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function all(Collection $request, $per_page = 15)
    {
        return Subscriber::where(
            function ($query) use ($request) {
                $this->setSearchColumn('email');
                $this->setSearchOnQuery($query, $request);
                $this->setFilterOnQuery($query, $request);
            }
        )->paginate($per_page);
    }

    /**
     * Resolves a new service for the given model.
     * 
     * @param \Illuminate\Database\Eloquent\Model
     * @return \App\Services\Subscriber\ISubscriberService
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
        return Subscriber::class;
    }
}
