<?php

namespace App\Services\Courses;

use App\Models\Course;
use Illuminate\Support\Collection;
use App\Services\SimpleModelService;

/**
 * Magic properties and methods
 * 
 * @property \App\Models\Course $course
 * @method \App\Models\Course course()
 * @method array metaKeywords()
 */
class CourseService extends SimpleModelService implements ICourseService
{
    /**
     * Checks if the given data passes the underlying model validations.
     * 
     * @param \Illuminate\Support\Collection $data
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return $this
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(Collection $data, $model = null)
    {
        validator($data->all(), Course::validationRules($model))->validate();

        return $this;
    }

    /**
     * Updates the model with the given data and saves it on the database.
     * 
     * @param \Illuminate\Support\Collection $data
     * @return bool
     */
    public function saveData(Collection $data)
    {
        $title = $data->get('title');
        $slug = strtolower(str_replace(' ', '-', $title));

        $this->course->title = $title;
        $this->course->active = $data->get('active');
        $this->course->slug = $slug;
        $this->course->url = $slug;

        $result = $this->course->save();

        $description = $data->get('description');
        $data->put('snippet', $this->snippetFromString($data->get('snippet'), $description));
        $data->put('meta_title', $data->get('meta_title') ?: trim($title) . ' | Zerodrop');
        $data->put('meta_description', $data->get('meta_description') ?: strip_tags($description));

        if (!$data->has('meta_keywords')) {
            $keywords = collect($this->course()->properties())->get('meta_keywords', '');
            $keywords = $this->metaKeywords() ?? $keywords;

            $data->put('meta_keywords', $keywords);
        }
        $this->course->saveProperties($data->all());

        return $result;
    }

    /**
     * Returns a 160 character snippet of the given text if it is not null. Or the snippet of the
     * default value.
     * 
     * @param string $value
     * @param mixed $default
     * @return string|null
     */
    protected function snippetFromString($value, $default = null)
    {
        if (is_null($value)) {
            return is_null($default) ? null : $this->snippetFromString($default);
        }
        return strlen($value) > 160 ? substr($value, 0, 160) . '...' : $value;
    }
}
