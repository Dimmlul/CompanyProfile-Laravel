<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a paginated list of users.
     *
     * Responsibilities:
     * - Retrieve users ordered by latest creation date
     * - Apply pagination
     * - Render the admin users index page
     */
    public function index()
    {
        return view('pages.admin.users.index', [
            'users' => User::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new user.
     *
     * Responsibilities:
     * - Render the user creation form
     */
    public function create()
    {
        return view('pages.admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * Responsibilities:
     * - Validate incoming request data
     * - Hash the user password securely
     * - Assign user role (user or admin)
     * - Persist the user record to the database
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:user,admin',
        ]);

        /**
         * Hash the password before storing it.
         */
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     *
     * Responsibilities:
     * - Load the user data
     * - Render the edit form
     */
    public function edit(User $user)
    {
        return view('pages.admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * Responsibilities:
     * - Prevent demotion of the last remaining admin
     * - Validate updated user data
     * - Hash password only if a new one is provided
     * - Persist user updates to the database
     */
    public function update(Request $request, User $user)
    {
        /**
         * SAFETY CHECK:
         * Prevent demoting the last remaining admin user.
         */
        if (
            $user->isAdmin() &&
            User::where('role', 'admin')->count() === 1 &&
            $request->role === 'user'
        ) {
            return back()->withErrors(
                'At least one admin must remain.'
            );
        }

        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|min:6',
            'role'     => 'required|in:user,admin',
        ]);

        /**
         * Update password only if a new one is provided.
         * Otherwise, keep the existing password.
         */
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated.');
    }

    /**
     * Remove the specified user from storage.
     *
     * Responsibilities:
     * - Prevent users from deleting their own account
     * - Prevent deletion of the last remaining admin
     * - Remove the user record from the database
     */
    public function destroy(User $user)
    {
        /**
         * SAFETY CHECK:
         * Prevent a user from deleting their own account.
         */
        if ($user->id === Auth::id()) {
            return back()->withErrors(
                'You cannot delete your own account.'
            );
        }

        /**
         * SAFETY CHECK:
         * Prevent deletion of the last remaining admin user.
         */
        if (
            $user->isAdmin() &&
            User::where('role', 'admin')->count() === 1
        ) {
            return back()->withErrors(
                'At least one admin must exist.'
            );
        }

        $user->delete();

        return back()->with('success', 'User deleted.');
    }
}
