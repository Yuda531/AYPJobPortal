<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobSeekers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $jobSeeker = $user->jobSeeker;

        return view('profile', compact('user', 'jobSeeker'));
    }

    public function update(Request $request)
    {
        try {
            // DB::beginTransaction();

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
            ]);

            $user->name = $validated['first_name'] . ' ' . $validated['last_name'];

            if ($request->hasFile('profile_picture')) {
                // $image = $request->file('profile_picture');
                // $imageData = base64_encode(file_get_contents($image->getRealPath()));
                // $user->profile_picture = $imageData;

                $image = $request->file('profile_picture');
                $binaryData = file_get_contents($image->getRealPath());
                $user->profile_picture = $binaryData;
            }

            $user->save();


            if ($user->role === 'job_seeker') {

                $jobSeeker = $user->jobSeeker ?? new JobSeekers();
                $jobSeeker->user_id = $user->id;
                $jobSeeker->phone = $validated['phone'] ?? null;
                $jobSeeker->location = $validated['location'] ?? null;
                $jobSeeker->title = $validated['title'] ?? null;
                $jobSeeker->bio = $validated['bio'] ?? null;
                $jobSeeker->skills = $validated['skills'] ?? null;
                $jobSeeker->save();
            }

            // DB::commit();

            return redirect()->route('profile')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            // DB::rollBack();
            var_dump('Error occurred:', $e->getMessage());
            Log::error('Profile update error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
