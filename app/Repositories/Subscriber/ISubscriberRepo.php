<?php

namespace App\Repositories\Subscriber;

use App\Repositories\ISimpleModelRepo;

interface ISubscriberRepo extends ISimpleModelRepo
{
    
    /**
     * Activates the subscription status of an existing subscriber. Returns the updated subscriber 
     * details.
     * 
     * @param String $email
     * @return \App\Models\Subscriber
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function subscribe($email);

    /**
     * Unsubscribes an existing subscriber from the database. Returns the updated subscriber details.
     * 
     * @param String $email
     * @return \App\Models\Subscriber
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function unsubscribe($email);

    /**
     * Resolves a new service for the given model.
     * 
     * @param \Illuminate\Database\Eloquent\Model
     * @return \App\Services\Subscriber\ISubscriberService
     */
    public function resolveService($model);
}
