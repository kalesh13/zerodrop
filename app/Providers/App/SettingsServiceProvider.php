<?php

namespace App\Providers\App;

use App\Contracts\ISettings;
use App\Services\Pages\Settings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class SettingsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application settings repository.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ISettings::class, function ($app) {
            return new Settings();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ISettings::class];
    }
}
