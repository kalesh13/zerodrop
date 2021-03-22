<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface ICanBeUpdatedViaForm
{
    /**
     * Checks if the given data passes the underlying model validations.
     * 
     * @param \Illuminate\Support\Collection $data
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return $this
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(Collection $data, $model = null);

    /**
     * Updates the model with the given data and saves it on the database.
     * 
     * @param \Illuminate\Support\Collection $data
     * @return bool
     */
    public function saveData(Collection $data);
}
