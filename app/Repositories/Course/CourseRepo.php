<?php

namespace App\Repositories\Course;

use App\Models\Course;
use App\Traits\HasSearchAndFilter;
use Illuminate\Support\Collection;
use App\Repositories\SimpleModelRepo;

class CourseRepo extends SimpleModelRepo implements ICourseRepo
{
    use HasSearchAndFilter;

    /**
     * Returns paginated list of all the newsletter subscribers.
     * 
     * @param \Illuminate\Support\Collection $request
     * @param int $per_page
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function all(Collection $request, $per_page = 15)
    {
        return Course::where(
            function ($query) use ($request) {
                $this->setSearchColumn('title');
                $this->setSearchOnQuery($query, $request);

                $this->setFilterColumn('status');
                $this->setFilterOnQuery($query, $request);
            }
        )->paginate($request->get('limit', $per_page));
    }

    /**
     * Resolves a new service for the given model.
     * 
     * @param \Illuminate\Database\Eloquent\Model
     * @return \App\Services\Courses\ICourseService
     */
    public function resolveService($model)
    {
        return parent::resolveService($model);
    }

    /**
     * Returns the model on which this service operates.
     * 
     * @return class
     */
    public function modelClass()
    {
        return Course::class;
    }
}
