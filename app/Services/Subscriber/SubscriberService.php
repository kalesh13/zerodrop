<?php

namespace App\Services\Subscriber;

use App\Models\Subscriber;
use Illuminate\Support\Collection;
use App\Services\SimpleModelService;

/**
 * Magic properties and methods
 * 
 * @property \App\Models\Subscriber $subscriber
 * @method \App\Models\Subscriber subscriber()
 */
class SubscriberService extends SimpleModelService implements ISubscriberService
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
        validator($data->all(), Subscriber::validationRules($model))->validate();

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
        $this->subscriber->email = $data->get('email');
        $this->subscriber->subscription = $data->get('subscription');

        return $this->subscriber->save();
    }
}
