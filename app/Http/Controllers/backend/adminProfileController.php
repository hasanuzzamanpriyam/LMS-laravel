<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\profileRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class adminProfileController extends Controller
{
    public function index()
    {
        return view('backend.admin.profile.index');
    }

    public function store(profileRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            // Unlink old image if it exists
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            // Store the new photo and get the path
            $path = $request->file('photo')->store('upload/admin_images', 'public');
            $data['photo'] = $path;
        }

        $user->update($data);

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    public function settings()
    {
        return view('backend.admin.profile.settings');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->with('error', "Current Password Doesn't Match!");
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password Changed Successfully');
    }
}
