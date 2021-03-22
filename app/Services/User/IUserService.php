<?php

namespace App\Services\User;

use App\Services\IBaseService;
use App\Services\IModelService;
use Illuminate\Support\Collection;
use App\Services\ICanBeUpdatedViaForm;

/**
 * Magic property and method.
 * 
 * @method \App\Models\User user()
 * @method int id()
 */
interface IUserService extends IBaseService, IModelService, ICanBeUpdatedViaForm
{
    /**
     * Checks if the given data passes all the validation checks of the User model.
     * Validation rules are different for password update and profile updates as these
     * are seperately updated from the frontend.
     * 
     * We allow passing array to `$password` parameter, so that we have control over a 
     * scenario where we have to validate only certain fields. 
     * 
     * If we pass an empty array as second argument, we will not pick any particular fields for 
     * validation, instead we validate all the rules. We will pick fields only when `$password` 
     * is either true or it is a non-empty array with field names in it.
     * 
     * @param \Illuminate\Support\Collection $data
     * @param bool|array $password
     * @param \App\Models\User $user
     * @return \App\Services\User\IUserService
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(Collection $data, $password = false, $user = null);

    /**
     * Updates the password of the user.
     * 
     * Note: Only the password field is updated and no other fields are touched.
     * 
     * @param \Illuminate\Support\Collection $data
     * @return bool
     */
    public function updatePassword(Collection $data);

    /**
     * Updates the user role to the given role. This saves the changes on the database.
     * 
     * @param string $role
     * @return bool
     */
    public function updateRole($role);

    /**
     * Sets the email on the user and returns this service object without saving
     * the user data.
     * 
     * @param string $email
     * @return \App\Services\User\IUserService
     */
    public function setEmail($email);

    /**
     * Sets the password on the user and returns this service object without saving
     * the user data.
     * 
     * @param string $password
     * @return \App\Services\User\IUserService
     */
    public function setPassword($password);

    /**
     * Checks if the given user is allowed to make changes to this user account.
     * 
     * @param \App\Models\User $user
     * @return bool
     */
    public function allowsUpdatesByUser($user);
}
