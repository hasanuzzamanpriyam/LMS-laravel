<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function login()
    {
        return view('backend.admin.login');
    }


    public function dashboard()
    {
        return view('backend.admin.dashboard.index');
    }

    public function destroy(Request $request)
    {
        auth()->guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
