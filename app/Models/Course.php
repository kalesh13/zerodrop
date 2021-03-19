<?php

namespace App\Models;

use App\Model\Traits\HasPropertyModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    use HasPropertyModel;

    /**
     * Returns all the details of this course.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseData()
    {
        return $this->hasMany(CourseData::class);
    }
}
