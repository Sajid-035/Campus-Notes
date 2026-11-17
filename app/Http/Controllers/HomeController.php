<?php

namespace App\Http\Controllers;

use App\Services\AdminDashboardData;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(AdminDashboardData $dashboardData)
    {
        $user = request()->user();
        if ($user && ($user->hasRole('Super Admin') || $user->can('dashboard-access'))) {
            return view('backend.dashboard', $dashboardData->make($user));
        }

        return app(\App\Http\Controllers\Frontend\StudentController::class)->dashboard(request());
    }
}
