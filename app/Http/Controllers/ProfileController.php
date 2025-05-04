<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobSeekers;
use Illuminate\Support\Facades\Log;
use App\Models\Employers;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user = null)
    {
        // If no user is provided, show the authenticated user's profile
        if (!$user) {
            $user = Auth::user();
        }

        $profile = null;
        if ($user->role === 'job_seeker') {
            $profile = $user->jobSeeker;
        } elseif ($user->role === 'employer') {
            $profile = $user->employer;
        }

        // Check if the profile being viewed is the authenticated user's profile
        $isOwnProfile = Auth::check() && Auth::id() === $user->id;

        return view('profile.show', compact('user', 'profile', 'isOwnProfile'));
    }

    public function update(Request $request)
    {
        try {
            $user = Auth::user();

            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'location' => 'nullable|string|max:255',
                'title' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
                'skills' => 'nullable|string',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'company_name' => 'nullable|string|max:255',
                'company_description' => 'nullable|string',
            ]);

            $user->name = $validated['first_name'] . ' ' . $validated['last_name'];

            if ($request->hasFile('profile_picture')) {
                $image = $request->file('profile_picture');
                $binaryData = file_get_contents($image->getRealPath());
                $user->profile_picture = $binaryData;
            }

            $user->save();

            if ($user->role === 'job_seeker') {
                $profile = $user->jobSeeker ?? new JobSeekers();
                $profile->user_id = $user->id;
                $profile->phone = $validated['phone'] ?? null;
                $profile->location = $validated['location'] ?? null;
                $profile->title = $validated['title'] ?? null;
                $profile->bio = $validated['bio'] ?? null;
                $profile->skills = $validated['skills'] ?? null;
                $profile->save();
            } elseif ($user->role === 'employer') {
                $profile = $user->employer ?? new Employers();
                $profile->user_id = $user->id;
                $profile->phone = $validated['phone'] ?? null;
                $profile->location = $validated['location'] ?? null;
                $profile->title = $validated['title'] ?? null;
                $profile->bio = $validated['bio'] ?? null;
                $profile->skills = $validated['skills'] ?? null;
                $profile->company_name = $validated['company_name'] ?? null;
                $profile->company_description = $validated['company_description'] ?? null;
                $profile->save();
            }

            return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred while updating your profile.');
        }
    }
}
