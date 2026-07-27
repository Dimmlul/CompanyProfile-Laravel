<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile page.
     *
     * Responsibilities:
     * - Retrieve the currently authenticated user
     * - Render the user profile page
     */
    public function index()
    {
        return view('pages.user.profile.index', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the authenticated user's profile information.
     *
     * Responsibilities:
     * - Validate profile input data
     * - Update basic user information (name and email)
     * - Update the password if a new password is provided
     * - Persist changes to the database
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        /**
         * Validate incoming profile update data.
         * - Email must remain unique, excluding the current user
         * - Password update is optional and must be confirmed
         */
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        /**
         * Update basic profile information.
         */
        $user->name  = $validated['name'];
        $user->email = $validated['email'];

        /**
         * Update password only if a new password is provided.
         */
        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        /**
         * Persist the updated user data.
         */
        $user instanceof User && $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
