<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface IBaseService
{
    /**
     * Updates the model with the given data and saves it on the database.
     * 
     * @param \Illuminate\Support\Collection $data
     * @return bool
     */
    public function update(Collection $data);

    /**
     * Deletes the model from the database.
     * 
     * @return bool|null
     */
    public function delete();
}
