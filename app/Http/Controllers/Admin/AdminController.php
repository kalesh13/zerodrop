<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\IUserRepo;

class AdminController extends Controller
{
    /**
     * Application user service repository.
     * 
     * @var \App\Repositories\User\IUserRepo
     */
    protected $user_repo;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\User\IUserRepo $user_repo
     */
    public function __construct(IUserRepo $user_repo)
    {
        $this->user_repo = $user_repo;
    }

    /**
     * Returns a view of the administrator backend dashboard.
     * 
     * @return \Illuminate\View\View
     */
    public function renderDashboard()
    {
        return view('administrator.dash');
    }

    /**
     * Render the backend login screen.
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function renderLogin()
    {
        if (!$this->user_repo->hasAdministrators()) {
            return redirect('admin/signup');
        }
        return view('administrator.login');
    }

    /**
     * Render the backend register screen.
     * 
     * @return \Illuminate\View\View
     */
    public function renderRegister()
    {
        return view('administrator.login');
    }
}
