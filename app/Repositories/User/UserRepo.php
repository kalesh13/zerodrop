<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepo;
use App\Traits\HasSearchAndFilter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class UserRepo extends BaseRepo implements IUserRepo
{
    use HasSearchAndFilter;

    /**
     * Creates a new user on the application, saves it on the database and returns a service 
     * wrapped around it.
     * 
     * @param array $data
     * @param bool $is_admin Default is `false`. Pass `true` to register as admin.
     * @param string $role Default is `Customer`. If `$is_admin` is set as true, then the 
     * role is internally set as `Administrator`
     */
    public function create(array $data, $is_admin = false, $role = 'Customer')
    {
        $data = collect($data);

        $service = $this->resolveService(new User());
        $service->validate($data, ['email', 'password']);
        $service
            ->setEmail($data->get('email'))
            ->setPassword($data->get('password'))
            ->saveData($data);

        $service->updateRole($is_admin ? 'Administrator' : $role);

        event(new Registered($user = $service->user()));

        return $user;
    }

    /**
     * Returns a user of the given id. Only user summary fields are returned. If a second
     * argument is provided with additional field names, they are also returned.
     * 
     * @param int $id
     * @param array $summary_columns
     * @return \App\Models\User
     */
    public function retreive($id = null, $summary_columns = [])
    {
        $user = is_null($id) ? $this->getAuthenticatedUser() : $this->get($id);

        return $user->load('role');
    }

    /**
     * Retreive all the account data for display on the administrator side. 
     * 
     * User needs "role" and "status" details appended to display the user role and 
     * email verification status on administrator page.
     * 
     * @param \Illuminate\Support\Collection $request
     * @param int $per_page
     */
    public function all(Collection $request, $per_page = 15)
    {
        $builder = User::with('role')
            ->where(function ($query) use ($request) {
                $this->setSearchColumn('email');
                $this->setSearchOnQuery($query, $request);
                $this->setWhereOnQuery($query, $request, 'id');
            })->latest('id');

        if ($request->has('filter')) {
            $builder->whereHas('role', function ($query) use ($request) {
                $query->where('role', $request->get('filter'));
            });
        };
        $paginator = $builder->paginate($per_page);

        $this->paginatorCollection($paginator)->each(function ($user) {
            $user->append(['role_name']);
        });
        return $paginator;
    }

    /**
     * Returns the number of administrator accounts registered on the application.
     * 
     * @return int
     */
    public function hasAdministrators()
    {
        return User::whereHas('role', function ($query) {
            $query->where('role', 'Administrator');
        })->get()->count();
    }

    /**
     * Returns the authenticated user.
     * 
     * If the argument `$shouldFail` is true and no user is authenticated, then the request 
     * fails with an abort 401 Unauthenticated exception. If the agument is false, then null 
     * is returned when no authenticated user is found.
     * 
     * @param bool $should_fail
     * @return \App\Models\User|null
     */
    public function getAuthenticatedUser($should_fail = true)
    {
        $user = Auth::user();

        if (is_null($user) && $should_fail) {
            return abort(401, 'Unathenticated');
        }
        return $user;
    }

    /**
     * Returns the model on which this service operates.
     * 
     * @return class
     */
    protected function modelClass()
    {
        return User::class;
    }
}
