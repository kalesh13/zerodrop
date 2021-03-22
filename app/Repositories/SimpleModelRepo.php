<?php

namespace App\Repositories;

abstract class SimpleModelRepo extends BaseRepo implements ISimpleModelRepo
{
    /**
     * Creates a new model from the given data, stores it into the database and returns
     * the same.
     * 
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $data = collect($data);

        $class = $this->modelClass();

        $service = $this->resolveService(new $class)->validate($data);

        $service->saveData($data);

        return $service->model();
    }

    /**
     * Updates the details of the given model with the given data and returns the same
     * model.
     * 
     * @param \Illuminate\Database\Eloquent\Model|int $model_or_id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($model_or_id, array $data)
    {
        $service = $this->resolveService($this->get($model_or_id));

        $service->update(collect($data));

        return $service->model();
    }

    /**
     * Deletes the given model from the database.
     * 
     * @param \Illuminate\Database\Eloquent\Model|int $model_or_id
     * @return bool
     */
    public function delete($model_or_id)
    {
        return $this->resolveService($this->get($model_or_id))->delete();
    }
}
