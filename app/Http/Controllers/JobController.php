<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobSeekers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\JobApplicantsExport;
use Maatwebsite\Excel\Facades\Excel;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Job::with('employer')->latest();
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }
        if ($request->filled('experience_level')) {
            $query->where('experience_level', $request->experience_level);
        }
        $jobs = $query->get();
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

    // Apply job (job_seeker)
    public function apply(Request $request, $jobId)
    {
        $user = Auth::user();
        if ($user->role !== 'job_seeker') {
            return back()->with('error', 'Only job seekers can apply.');
        }
        $jobSeeker = $user->jobSeeker;
        if (!$jobSeeker) {
            return back()->with('error', 'Please complete your job seeker profile first.');
        }
        $job = Job::findOrFail($jobId);
        // Cek sudah apply
        if (JobApplication::where('job_id', $job->id)->where('job_seeker_id', $jobSeeker->id)->exists()) {
            return back()->with('error', 'You have already applied for this job.');
        }
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:1024',
        ]);
        $resumePath = $request->file('resume')->store('resumes', 'public');
        JobApplication::create([
            'job_id' => $job->id,
            'job_seeker_id' => $jobSeeker->id,
            'resume' => $resumePath,
        ]);
        return back()->with('success', 'Application submitted successfully!');
    }

    // Employer: list pelamar untuk job tertentu
    public function applicants($jobId)
    {
        $user = Auth::user();
        if ($user->role !== 'employer' || !$user->employer) {
            return redirect()->route('jobs.index')->with('error', 'Unauthorized.');
        }
        $job = Job::with('applications.jobSeeker.user')->where('employer_id', $user->employer->id)->findOrFail($jobId);
        $applications = $job->applications;
        return view('jobs.applicants', compact('job', 'applications'));
    }

    // Employer: detail pelamar
    public function applicantDetail($applicationId)
    {
        $user = Auth::user();
        if ($user->role !== 'employer' || !$user->employer) {
            return redirect()->route('jobs.index')->with('error', 'Unauthorized.');
        }
        $application = JobApplication::with('job', 'jobSeeker.user')->findOrFail($applicationId);
        // Cek apakah job ini milik employer
        if ($application->job->employer_id !== $user->employer->id) {
            return redirect()->route('jobs.index')->with('error', 'Unauthorized.');
        }
        return view('jobs.applicant_detail', compact('application'));
    }

    // Export applicants to Excel
    public function exportApplicantsExcel($jobId)
    {
        $user = Auth::user();
        if ($user->role !== 'employer' || !$user->employer) {
            return redirect()->route('jobs.index')->with('error', 'Unauthorized.');
        }
        $job = Job::with('applications.jobSeeker.user')->where('employer_id', $user->employer->id)->findOrFail($jobId);
        $applications = $job->applications;
        $export = new JobApplicantsExport($job, $applications);
        $fileName = 'Applicants_for_' . str_replace(' ', '_', $job->title) . '.xlsx';
        return Excel::download($export, $fileName);
    }
}
