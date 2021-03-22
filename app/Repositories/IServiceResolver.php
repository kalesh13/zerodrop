<?php

namespace App\Repositories;

interface IServiceResolver
{
    /**
     * Resolves a new service for the given model.
     * 
     * @param \Illuminate\Database\Eloquent\Model
     */
    public function resolveService($model);
}