<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface IBaseRepo extends IServiceResolver
{
    /**
     * Returns a model from the given model id.
     * 
     * @param int $id
     * @param bool $fail Set this to false to prevent exception on failure.
     * @return \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Model|null
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get($id, $fail = true);

    /**
     * Returns all the models of this repo.
     * 
     * @param \Illuminate\Support\Collection $request
     * @param int $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(Collection $request, $per_page = 15);
}
