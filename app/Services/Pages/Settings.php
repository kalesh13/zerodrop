<?php

namespace App\Services\Pages;

use App\Contracts\ISettings;

class Settings extends PageBase implements ISettings
{
    /**
     * Name of the page in the database.
     * 
     * @var string
     */
    protected $page_name = 'settings';

    /**
     * Shares the application settings with all the views in a `settings` key.
     * 
     * App settings are also saved as a Page model in the database. So that the details
     * can be updated from the backend just like any other pages. Please take a look at 
     * the `defaultProperties()` given below to know the settings of this web application.
     */
    public function shareSettings()
    {
        view()->share('settings', $this->properties());
    }

    /**
     * Returns the default properties of this page.
     * 
     * @return array
     */
    protected function defaultProperties()
    {
        return [
            'logo' => '/images/logo.png',
            'contact_email' => 'contact@zerodrop.in',
            'address_line_1' => 'ZeroDrop Training Academy',
            'street_address' => '',
            'city' => 'Eranakulam',
            'state' => 'Kerala',
            'country' => 'IN',
            'pin' => '690518',
            'phone_1' => '+91-04762620032',
            'phone_2' => '',
            'fb_url' => 'https://facebook.com/zerodrop',
            'twitter_url' => 'https://twitter.com/zerodrop',
            'insta_url' => 'https://instagram.com/zerodrop',
            'youtube_url' => 'https://youtube.com/zerodrop',
        ];
    }
}