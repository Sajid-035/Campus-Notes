<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function home(): View
    {
        return view('frontend.pages.home');
    }

    public function features(): View
    {
        return view('frontend.pages.features');
    }

    public function howItWorks(): View
    {
        return view('frontend.pages.how-it-works');
    }

    public function about(): View
    {
        return view('frontend.pages.about');
    }

    public function contact(): View
    {
        return view('frontend.pages.contact');
    }
}
