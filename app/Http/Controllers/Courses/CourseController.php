<?php

namespace App\Http\Controllers\Courses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Course\ICourseRepo;

class CourseController extends Controller
{
    /**
     * Application course repository.
     * 
     * @var \App\Repositories\Course\ICourseRepo
     */
    protected $course_repo;

    /**
     * Controller that takes care of the CRUD operations of courses.
     * 
     * @param \App\Repositories\Course\ICourseRepo $course_repo
     */
    public function __construct(ICourseRepo $course_repo)
    {
        $this->course_repo = $course_repo;
    }

    /**
     * Returns the view that renders the page which shows all the courses.
     * 
     * @return \Illuminate\View\View
     */
    public function renderAll()
    {
        return view('courses_page');
    }

    /**
     * Returns the view that renders a single course page.
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function renderCourse($id)
    {
        return view('courses_page')->with('data', $this->retreive($id)->toArray());
    }

    /**
     * Creates a new course using the `$request` inputs and returns the newly created
     * course model.
     * 
     * @return \App\Models\Course
     */
    public function create(Request $request)
    {
        return $this->course_repo->create($request->all());
    }

    /**
     * Returns the course with the given `id`.
     * 
     * @param int $id
     * @return \App\Models\Course
     */
    public function retreive($id)
    {
        return $this->course_repo->get($id);
    }

    /**
     * Returns all the courses registered in the application.
     * 
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function all(Request $request)
    {
        return $this->course_repo->all(collect($request->all()));
    }

    /**
     * Updates the course with the given `$id` using the `$request` inputs and returns the 
     * updated course model.
     * 
     * @return \App\Models\Course
     */
    public function update(Request $request, $id)
    {
        return $this->course_repo->update($id, $request->all());
    }

    /**
     * Deletes a course from the database. The `id` of the course has to be POSTed as a request
     * parameter.
     * 
     * @return bool|null
     */
    public function delete(Request $request)
    {
        return $this->course_repo->delete($request->id);
    }
}
