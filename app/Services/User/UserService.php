<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Arr;
use App\Services\ModelService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

/**
 * Magic property and method.
 * 
 * @property \App\Models\User $user 
 * @method \App\Models\User user()
 * @method int id()
 */
class UserService extends ModelService implements IUserService
{
    /**
     * Updates and saves the user with the given data.
     * 
     * Only fields other than password is updated using this method.
     * 
     * @param \Illuminate\Support\Collection $data
     * @return bool
     */
    public function update(Collection $data)
    {
        return $this->validate($data, false, $this->user())
            ->setEmail($data->get('email'))
            ->saveData($data);
    }

    /**
     * Updates the password of the user.
     * 
     * Note: Only the password field is updated and no other fields are touched.
     * 
     * @param \Illuminate\Support\Collection $data
     * @return bool
     */
    public function updatePassword(Collection $data)
    {
        return $this->validate($data, true)
            ->setPassword($data->get('password'))
            ->user()
            ->save();
    }

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
    public function validate(Collection $data, $password = false, $user = null)
    {
        if (true === $password || is_array($password)) {
            $rule = User::validationRules($user);

            $only_fields_to_check = ['password'];

            // We allow passing array to `$password` parameter, so that we have 
            // control over a scenario where we have to validate only certain fields.
            // Set the only fields to check to the password array if it is an array.
            if (is_array($password)) {
                $only_fields_to_check = $password;
            }

            // If we pass an empty array as second argument, `$only_fields_to_check` will
            // be empty and we will not pick any particular fields for validation, instead
            // we validate all the rules. We will pick fields only when `$password` is either 
            // true or it is a non-empty array with field names in it.
            if ($only_fields_to_check) {
                $rule = Arr::only($rule, $only_fields_to_check);
            }
        }
        // When `$password` parameter is false, we will have to validate for
        // all the field except password. For example, profile updates won't 
        // include password updates, so we will check all fields except password.
        else {
            $rule = Arr::except(User::validationRules($user), 'password');
        }
        validator($data->all(), $rule)->validate();

        return $this;
    }

    /**
     * Updates the user role to the given role. This saves the changes on the database.
     * 
     * @param string $role
     * @return bool
     */
    public function updateRole($role)
    {
        return $this->user->assignRole($role);
    }

    /**
     * Updates the user with the given data and saves it on the database.
     * 
     * @param \Illuminate\Support\Collection $data
     * @return bool
     */
    public function saveData(Collection $data)
    {
        $result = $this->user->save();

        $this->user->saveProperties($data->except(['email', 'password'])->all());

        return $result;
    }

    /**
     * Deletes the ticket from the database.
     * 
     * @return bool|null
     */
    public function delete()
    {
        return $this->user->delete();
    }

    /**
     * Sets the email on the user and returns this service object without saving
     * the user data.
     * 
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->user->email = $email;

        return $this;
    }

    /**
     * Sets the password on the user and returns this service object without saving
     * the user data.
     * 
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->user->password = Hash::make($password);

        return $this;
    }

    /**
     * Checks if the given user is allowed to make changes to this user account.
     * 
     * @param \App\Models\User $user
     * @return bool
     */
    public function allowsUpdatesByUser($user)
    {
        if (!$user) return false;

        return $user->isAdministrator() || $user->id === $this->user->id;
    }
}
