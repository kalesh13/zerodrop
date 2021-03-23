<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Model\Traits\HasPropertyModel;
use Illuminate\Database\Eloquent\Model;
use App\Model\Contracts\PropertyModelContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model implements PropertyModelContract
{
    use HasFactory;
    use HasPropertyModel;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['courseData'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['duration', 'start', 'url'];

    /**
     * Returns all the details of this course.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseData()
    {
        return $this->hasMany(CourseData::class);
    }

    /**
     * Parses the course start date to a Carbon instance before saving to database.
     * 
     * @return string
     */
    public function setStartProperty($value)
    {
        return Carbon::createFromFormat('d/m/Y h:i A', $value);
    }

    /**
     * Returns the course duration as a presentable text.
     * 
     * @return string
     */
    public function getDurationAttribute($value)
    {
        if ($value > 31) {
            $months = $value - 31;
            return $months . ' ' . ($months == 1 ? 'Month' : 'Months');
        }
        return $value . ' ' . ($value == 1 ? 'Day' : 'Days');
    }

    /**
     * Returns the course start date as a presentable text.
     * 
     * @return string
     */
    public function getStartAttribute($value)
    {
        return Carbon::parse($value)->format('M j, Y');
    }

    /**
     * Returns the url of the course page.
     * 
     * @return string
     */
    public function getUrlAttribute($value)
    {
        return '/course' . '/' . $this->getKey() . '/' . $value;
    }

    /**
     * Returns the list of properties allowed in the model with their
     * default values.
     * 
     * @return array array containing the default property values
     */
    public function properties()
    {
        return [
            'description' => '',
            'snippet' => '',
            'duration' => '',
            'start' => '',
            'eligibility' => '',
            'course_fees' => '',
            'course_image' => '',
            'brochure_file' => '',
            'application_file' => '',
            'meta_title' => 'Course | Zerodrop',
            'meta_description' => 'We believe that with the right education and training, any competent industry professional can become proficient in dealing with a whole range of up-stream and down-stream valve and control system issues – even in the world’s most hostile working environments.',
            'meta_keywords' => 'courses, about zerodrop, zerodrop, technical training center, technical training centre, technical, training, center, training centre, technical training, valve, valve engineering, valve design',
        ];
    }

    /**
     * Returns the validation rules of this model.
     * 
     * If a Course model is passed as an argument, then the validation should ignore
     * the given model when performing a unique index check.
     * 
     * @param \App\Models\Course $course
     * @return array
     */
    public static function validationRules($course = null)
    {
        $unique_course = Rule::unique('courses');

        if (!is_null($course)) {
            $unique_course = $unique_course->ignoreModel($course);
        }

        return [
            'title' => ['bail', 'required', 'max:255', $unique_course],
            'description' => 'required',
            'duration' => 'required',
            'start' => 'required',
            'active' => 'required|boolean',
        ];
    }
}
