<?php

namespace App\Services;

interface IModelService
{
    /**
     * Returns the underlying model of the ModelService.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model();
}
