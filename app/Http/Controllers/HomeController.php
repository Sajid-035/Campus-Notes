<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $user = request()->user();
        if ($user && ($user->hasRole('Super Admin') || $user->can('dashboard-access'))) {
            $data = Todo::all();
            return view('backend.dashboard', compact('data'));
        }

        return app(\App\Http\Controllers\Frontend\StudentController::class)->dashboard(request());
    }
}
