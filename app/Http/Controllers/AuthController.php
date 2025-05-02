<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\JobSeekers;
use App\Models\Employers;
use Exception;

class AuthController extends Controller
{
    public function register()
    {
        return view("auth/register");
    }

    public function registerAction(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'role' => 'required|in:job_seeker,employer',
                'company_name' => 'required_if:role,employer',
                'company_description' => 'required_if:role,employer',
                'phone' => 'required_if:role,employer',
                'location' => 'required_if:role,employer',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role']
            ]);

            if ($validated['role'] === 'job_seeker') {
                JobSeekers::create(['user_id' => $user->id]);
            } else {
                Employers::create([
                    'user_id' => $user->id,
                    'company_name' => $validated['company_name'],
                    'company_description' => $validated['company_description'],
                    'phone' => $validated['phone'],
                    'location' => $validated['location'],
                ]);
            }

            Auth::login($user);
            return redirect()->route('login')->with('success', 'Registration successful! Please login.');
        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard')->with('success', 'Welcome back!');
            }

            return back()->withInput()
                ->withErrors([
                    'error' => 'The provided credentials do not match our records.',
                ]);
        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Login failed. Please try again.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }

    public function profile()
    {
        return view('profile');
    }
}
