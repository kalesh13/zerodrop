<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasTimestampAttributes
{
    /**
     * Converts the given `created_at` time in UTC to Chicago (CDT) time and returns
     * it in ISO8601 format.
     * 
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value, 'UTC')->setTimezone('America/Chicago')->toIso8601String();
    }

    /**
     * Converts the given `updated_at` time in UTC to Chicago (CDT) time and returns
     * it in ISO8601 format.
     * 
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value, 'UTC')->setTimezone('America/Chicago')->toIso8601String();
    }
}
