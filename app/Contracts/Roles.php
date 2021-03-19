<?php

namespace App\Contracts;

interface Roles
{
    /**
     * Return the role of the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role();

    /**
     * Checks whether the user is an administrator or not.
     * 
     * @return bool
     */
    public function isAdministrator();

    /**
     * Check whether the user has a role.
     * 
     * @param string $role_name
     * @return bool
     */
    public function hasRole($role_name);

    /**
     * Assign a role to this user.
     * 
     * @param string $role_name
     * @return bool
     */
    public function assignRole($role_name);
}