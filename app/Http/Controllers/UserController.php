<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // Show a list of all users (excluding Super Admin)
    public function index()
    {
        $users = User::where('is_hidden', false)->paginate(10);
        return view('users.index', compact('users'));
    }

    // Show the form to create a new user
    public function create()
    {
        return view('users.create');
    }

    // Store the new user in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:Admin,User',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show the edit form for a user
    public function edit($id)
    {
        $user = User::findOrFail($id);

        if ($user->is_hidden) {
            abort(403, 'You cannot modify the Super Admin.');
        }

        return view('users.edit', compact('user'));
    }

    // Update the user in the database
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:Admin,User',
        ], [
            'name.required' => 'Please enter the user\'s name.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already taken.',
            'role.required' => 'Please select a user privilege.',
            'role.in' => 'Invalid role selected.',
        ]);

        // Manual validation for password and confirmation
        if ($request->filled('password') || $request->filled('password_confirmation')) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|same:password',
            ], [
                'password.required' => 'Please enter a new password.',
                'password.min' => 'Password must be at least 6 characters.',
                'password_confirmation.required' => 'Please confirm your new password.',
                'password_confirmation.same' => 'Password confirmation does not match.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        try {
            $user = User::findOrFail($id);

            if ($user->is_hidden) {
                abort(403, 'You cannot update the Super Admin.');
            }

            // Prevent role change for Super Admin
            if ($user->is_hidden && $request->role !== 'Admin') {
return back()->withErrors(['role' => 'Cannot change Super Admin role.']);
            }
                    $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    } catch (\Exception $e) {
        Log::error('User update failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to update user. Please try again.');
    }
}

// Delete a user
public function destroy($id)
{
    try {
        $user = User::findOrFail($id);

        if ($user->is_hidden) {
            return redirect()->route('users.index')->with('error', 'You cannot delete the Super Admin.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    } catch (\Exception $e) {
        Log::error('User deletion failed: ' . $e->getMessage());
        return redirect()->route('users.index')->with('error', 'Failed to delete user.');
    }
}
}
