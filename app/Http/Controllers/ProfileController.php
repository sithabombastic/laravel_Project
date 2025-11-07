<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('profile.show', compact('user'));
        } else {
            return redirect()->route('login')->with('error', 'Please Login First.');
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:Admin,User',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($rules);

        $user = Auth::user();

        //Restrict email and role changes for non-admins
        if ($user->role !== 'Admin') {
            $request->merge([
                'email' => $user->email,
                'role' => $user->role,
            ]);
        }

        //Handle photo upload
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }
            $path = $request->file('photo')->store('profile_photos', 'public');
            $user->photo = $path;
        }

        //Update fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile Updated Successfully.');
    }


    // Delete Profile Photo
    public function deletePhoto()
    {
        $user = Auth::user();
        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
            $user->photo = null;
            $user->save();
        }

        return redirect()->back()->with('success', 'Photo Deleted Successfully.');
    }

    // Auto Upload Profile
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }

        $path = $request->file('photo')->store('profile_photos', 'public');
        $user->photo = $path;
        $user->save();

        return redirect()->back()->with('success', 'Photo uploaded successfully.');
    }
}
