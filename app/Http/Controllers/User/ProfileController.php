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
     * Show user profile page
     */
    public function index()
    {
        return view('pages.user.profile.index', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        // update basic data
        $user->name  = $validated['name'];
        $user->email = $validated['email'];

        // update password (if filled)
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user instanceof User && $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
