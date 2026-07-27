<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display the login page.
     *
     * Responsibilities:
     * - Render the login form view
     */
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    /**
     * Display the registration page.
     *
     * Responsibilities:
     * - Render the user registration form view
     */
    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    /**
     * Handle an authentication (login) request.
     *
     * Responsibilities:
     * - Validate login credentials
     * - Attempt user authentication
     * - Regenerate the session to prevent session fixation
     * - Redirect users based on their role
     *   (admin > admin dashboard, user > homepage)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        /**
         * Attempt to authenticate the user using the provided credentials.
         */
        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid email or password',
            ]);
        }

        /**
         * Regenerate the session after successful login
         * to protect against session fixation attacks.
         */
        $request->session()->regenerate();

        $user = Auth::user();

        /**
         * Redirect users based on their role.
         */
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }

    /**
     * Handle a user registration request.
     *
     * Responsibilities:
     * - Validate registration input data
     * - Create a new user account
     * - Securely hash the user password
     * - Assign the default "user" role
     * - Automatically authenticate the new user
     * - Redirect the user to the homepage
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        /**
         * Create a new user with the default role.
         */
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
        ]);

        /**
         * Automatically log in the newly registered user.
         */
        Auth::login($user);

        return redirect()->route('home');
    }

    /**
     * Handle the logout process.
     *
     * Responsibilities:
     * - Log out the authenticated user
     * - Invalidate the current session
     * - Regenerate the CSRF token
     * - Redirect the user to the login page
     */
    public function logout(Request $request)
    {
        Auth::logout();

        /**
         * Invalidate and regenerate session data
         * to ensure a clean logout state.
         */
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
