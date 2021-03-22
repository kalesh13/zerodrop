<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Zauth\Laravel\RegistersUsers;
use App\Http\Controllers\Controller;
use App\Repositories\User\IUserRepo;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';


    /**
     * Application user service repository.
     * 
     * @var \App\Repositories\User\IUserRepo
     */
    protected $user_repo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IUserRepo $user_repo)
    {
        $this->user_repo = $user_repo;

        $this->middleware('admin.guest');
    }

    /**
     * Registers a new user on the application.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function register(Request $request)
    {
        $user = $this->user_repo->create($request->all());

        $this->guard()->login($user);

        return $request->wantsJson()
            ? $user->append(['access_token', 'redirect_to'])
            : redirect($this->redirectPath());
    }
}
