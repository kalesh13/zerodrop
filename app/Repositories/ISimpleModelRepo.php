<?php

namespace App\Repositories;

interface ISimpleModelRepo extends IBaseRepo
{
    /**
     * Creates a new model from the given data, stores it into the database and returns
     * the same.
     * 
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);

    /**
     * Updates the details of the given model with the given data and returns the same
     * model.
     * 
     * @param \Illuminate\Database\Eloquent\Model|int $model_or_id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($model_or_id, array $data);

    /**
     * Deletes the given model from the database.
     * 
     * @param \Illuminate\Database\Eloquent\Model|int $model_or_id
     * @return bool|null
     */
    public function delete($model_or_id);

    /**
     * Resolves a new service for the given model.
     * 
     * @param \Illuminate\Database\Eloquent\Model
     * @return \App\Services\ISimpleModelService
     */
    public function resolveService($model);
}
