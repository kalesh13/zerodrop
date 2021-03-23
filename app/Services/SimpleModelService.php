<?php

namespace App\Services;

use Illuminate\Support\Collection;

abstract class SimpleModelService extends ModelService implements ISimpleModelService
{
    /**
     * Updates the model with the given data and saves it on the database.
     * 
     * @param \Illuminate\Support\Collection $data
     * @return bool
     */
    public function update(Collection $data)
    {
        return $this->validate($data, $this->model)->saveData($data);
    }

    /**
     * Deletes the model from the database.
     * 
     * @return bool|null
     */
    public function delete()
    {
        return $this->model->delete();
    }
}
