<?php

namespace App\Services\Subscriber;

use App\Models\Subscriber;
use App\Services\ModelService;
use Illuminate\Support\Collection;

/**
 * Magic properties and methods
 * 
 * @property \App\Models\Subscriber $subscriber
 * @method \App\Models\Subscriber subscriber()
 */
class SubscriberService extends ModelService implements ISubscriberService
{
    /**
     * Updates the model with the given data and saves it on the database.
     * 
     * @param \Illuminate\Support\Collection $data
     * @return bool
     */
    public function update(Collection $data)
    {
        return $this->validate($data, $this->subscriber())->saveData($data);
    }

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

    /**
     * Deletes the model from the database.
     * 
     * @return bool|null
     */
    public function delete()
    {
        return $this->subscriber->save();
    }
}
