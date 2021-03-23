<?php

namespace App\Repositories\Course;

use App\Repositories\ISimpleModelRepo;

interface ICourseRepo extends ISimpleModelRepo
{
    /**
     * Resolves a new service for the given model.
     * 
     * @param \Illuminate\Database\Eloquent\Model
     * @return \App\Services\Courses\ICourseService
     */
    public function resolveService($model);
}
