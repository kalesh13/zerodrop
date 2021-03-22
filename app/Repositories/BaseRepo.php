<?php

namespace App\Repositories;

abstract class BaseRepo extends ServiceResolver implements IBaseRepo
{
    /**
     * Returns the model class on which this service factory operates.
     * 
     * @return class
     */
    protected abstract function modelClass();

    /**
     * Returns the item collection from the paginator.
     * 
     * @param \Illuminate\Pagination\AbstractPaginator $paginator
     * @return \Illuminate\Support\Collection
     */
    protected function paginatorCollection($paginator)
    {
        return $paginator->getCollection();
    }

    /**
     * Returns a model from the given model id.
     * 
     * @param int|array|\Illuminate\Database\Eloquent\Model $id
     * @param bool $fail Set this to false to prevent throwing exception on failure.
     * @return \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Model|null
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get($id, $fail = true)
    {
        $class = $this->modelClass();

        if ($id instanceof $class) {
            return $id;
        }

        if ($fail) {
            return $this->getQuery()->findOrFail($id);
        }

        if (!is_null($id)) {
            return $this->getQuery()->find($id);
        }
    }

    /**
     * Returns a query object on the underlying repo model. This function allows 
     * us to update the query conditions without overriding the `get` method.
     * 
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    protected function getQuery()
    {
        $class = $this->modelClass();

        return $class::query();
    }
}