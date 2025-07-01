@extends('layouts.app2')

@section('content')
    <div class="container vh-100 py-4">
        <a href="{{ route('jobs.applicants', $application->job->id) }}" class="btn btn-secondary mb-3"> <i
                class="fas fa-arrow-left"></i> Back
            to Applicants</a>
        <h2>Applicant Detail</h2>
        <div class="card">
            <div class="card-body">
                <h4>{{ $application->jobSeeker->user->name ?? '-' }}</h4>
                <p><strong>Email:</strong> {{ $application->jobSeeker->user->email ?? '-' }}</p>
                <p><strong>Phone:</strong> {{ $application->jobSeeker->phone ?? '-' }}</p>
                <p><strong>Location:</strong> {{ $application->jobSeeker->location ?? '-' }}</p>
                <p><strong>Title:</strong> {{ $application->jobSeeker->title ?? '-' }}</p>
                <p><strong>Bio:</strong> {{ $application->jobSeeker->bio ?? '-' }}</p>
                <p><strong>Skills:</strong> {{ $application->jobSeeker->skills ?? '-' }}</p>
                <p><strong>Resume:</strong> <a href="{{ asset('storage/' . $application->resume) }}" target="_blank"
                        class="btn btn-success btn-sm">Download Resume</a></p>
            </div>
        </div>
    </div>
@endsection
