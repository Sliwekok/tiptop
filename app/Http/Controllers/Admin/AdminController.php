<?php

namespace App\Http\Controllers;

use App\Http\Services\Admin\AdminService;

class AdminController extends Controller
{

    /**
     * @var AdminService
     */
    private $adminService;

    /**
     * AdminController constructor.
     * @param AdminService $adminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
        $this->middleware('admin');
    }

    public function dashboardView()
    {
        return view('admin.dashboard');
    }

}
