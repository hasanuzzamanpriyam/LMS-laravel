<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class instructorController extends Controller
{
    public function login()
    {
        return view('backend.instructor.login');
    }

    public function dashboard()
    {
        return view('backend.instructor.dashboard.index');
    }

    public function destroy(Request $request)
    {
        auth()->guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/instructor/login');
    }
}
