<?php

namespace App\Providers\App;

use App\Services\Pages\PageFactory;
use App\Services\Pages\IPageFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class PagesServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application page repository.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IPageFactory::class, function ($app) {
            return new PageFactory();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [IPageFactory::class];
    }
}