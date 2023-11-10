<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class CustomerDashboardController extends Controller
{
    public function dashboard()
    {
        return view('frontend.common.dashboard');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
