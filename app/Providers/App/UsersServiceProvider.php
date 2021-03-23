<?php

namespace App\Providers\App;

use App\Services\User\UserService;
use App\Repositories\User\UserRepo;
use App\Repositories\User\IUserRepo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class UsersServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application user repository.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IUserRepo::class, function ($app) {
            return new UserRepo(function ($model) {
                return new UserService($model);
            });
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [IUserRepo::class];
    }
}
