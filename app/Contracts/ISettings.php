<?php

namespace App\Contracts;

interface ISettings extends PageContract
{
    /**
     * Shares the application settings with all the views in a `settings` key.
     * 
     * This is done by loading the settings page details from the database and
     * using its properties. Settings page handles all the application settings.
     * Please take a look at the `defaultProperties()` given below to know the
     * settings of this web application.
     */
    public function shareSettings();
}