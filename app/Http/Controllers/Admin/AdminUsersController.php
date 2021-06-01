<?php

namespace App\Http\Controllers;


use App\Http\Services\Admin\AdminService;
use App\Http\Services\Admin\AdminUsersService;
use App\User;

class AdminUsersController
{

    /**
     * @var AdminService
     */
    private $adminService;

    /**
     * @var AdminUsersService
     */
    private $adminUsersService;

    /**
     * AdminUsersController constructor.
     * @param AdminService $adminService
     * @param AdminUsersService $adminUsersService
     */
    public function __construct(AdminService $adminService, AdminUsersService $adminUsersService)
    {
        $this->adminService = $adminService;
        $this->adminUsersService = $adminUsersService;
    }

    public function listView()
    {

        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users.list', [
            'users' => $users
        ]);
    }

}