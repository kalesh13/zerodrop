<?php

namespace App\Repositories\User;

use App\Repositories\IBaseRepo;

interface IUserRepo extends IBaseRepo
{
    /**
     * Creates a new user on the application.
     * 
     * @param array $data
     * @param bool $is_admin
     * @param string $role If `$is_admin` is set as true, this value is ignored.
     * @return \App\Models\User
     */
    public function create(array $data, $is_admin = false, $role = 'Customer');

    /**
     * Returns the number of administrator accounts registered on the application.
     * 
     * @return int
     */
    public function hasAdministrators();

    /**
     * Returns the authenticated user.
     * 
     * If the argument `$should_fail` is true and no user is authenticated, then the request 
     * fails with an abort 401 Unauthenticated exception. If the agument is false, then null 
     * is returned when no authenticated user is found.
     * 
     * @param bool $should_fail
     * @return \App\Models\User|null
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getAuthenticatedUser($should_fail = true);

    /**
     * Resolves a new service for the given model.
     * 
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return \App\Services\User\IUserService
     */
    public function resolveService($model);
}