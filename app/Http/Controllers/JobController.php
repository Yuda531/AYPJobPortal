<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jobs = Job::with('employer')->latest()->get();
        $isEmployer = Auth::user()->role === 'employer';
        return view('jobs.index', compact('jobs', 'isEmployer'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'employer') {
            return redirect()->route('jobs.index')->with('error', 'Only employers can post jobs.');
        }
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'employer') {
            return redirect()->route('jobs.index')->with('error', 'Only employers can post jobs.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'job_type' => 'required|in:full-time,part-time,internship',
            'experience_level' => 'required|in:no_experience,entry,mid,senior,expert',
            'deadline' => 'required|date|after:today',
            'skills' => 'required|string|max:255',
        ]);

        $employer = Auth::user()->employer;

        if (!$employer) {
            return redirect()->route('jobs.index')->with('error', 'Please complete your employer profile first.');
        }

        // Format description as HTML list
        $description = explode("\n", $validated['description']);
        $formattedDescription = '<ul>';
        foreach ($description as $line) {
            if (trim($line) !== '') {
                $formattedDescription .= '<li>' . trim($line) . '</li>';
            }
        }
        $formattedDescription .= '</ul>';
        $validated['description'] = $formattedDescription;

        // Format requirements as HTML list
        $requirements = explode("\n", $validated['requirements']);
        $formattedRequirements = '<ul>';
        foreach ($requirements as $requirement) {
            if (trim($requirement) !== '') {
                $formattedRequirements .= '<li>' . trim($requirement) . '</li>';
            }
        }
        $formattedRequirements .= '</ul>';
        $validated['requirements'] = $formattedRequirements;

        $validated['employer_id'] = $employer->id;

        Job::create($validated);

        return redirect()->route('jobs.index')->with('success', 'Job posted successfully!');
    }

    public function show($id)
    {
        $job = Job::with('employer')->findOrFail($id);
        $similarJobs = Job::where('job_type', $job->job_type)
            ->where('id', '!=', $job->id)
            ->take(2)
            ->get();
        return view('jobs.show', compact('job', 'similarJobs'));
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);

        // Check if the user is the employer who posted this job
        if (Auth::user()->role !== 'employer' || Auth::user()->employer->id !== $job->employer_id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to edit this job.');
        }

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        // Check if the user is the employer who posted this job
        if (Auth::user()->role !== 'employer' || Auth::user()->employer->id !== $job->employer_id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to update this job.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'job_type' => 'required|in:full-time,part-time,internship',
            'experience_level' => 'required|in:no_experience,entry,mid,senior,expert',
            'deadline' => 'required|date|after:today',
            'skills' => 'required|string|max:255',
        ]);

        // Format description as HTML list
        $description = explode("\n", $validated['description']);
        $formattedDescription = '<ul>';
        foreach ($description as $line) {
            if (trim($line) !== '') {
                $formattedDescription .= '<li>' . trim($line) . '</li>';
            }
        }
        $formattedDescription .= '</ul>';
        $validated['description'] = $formattedDescription;

        // Format requirements as HTML list
        $requirements = explode("\n", $validated['requirements']);
        $formattedRequirements = '<ul>';
        foreach ($requirements as $requirement) {
            if (trim($requirement) !== '') {
                $formattedRequirements .= '<li>' . trim($requirement) . '</li>';
            }
        }
        $formattedRequirements .= '</ul>';
        $validated['requirements'] = $formattedRequirements;

        $job->update($validated);

        return redirect()->route('jobs.show', $job->id)->with('success', 'Job updated successfully!');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);

        // Check if the user is the employer who posted this job
        if (Auth::user()->role !== 'employer' || Auth::user()->employer->id !== $job->employer_id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to delete this job.');
        }

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}
