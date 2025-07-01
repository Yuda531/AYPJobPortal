@php
    use App\Models\Job;
@endphp

@extends('layouts.app2')

@section('content')
    <div class="container py-4">
        <div class="row pt-3">
            <!-- Main Content -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h2 class="card-title">{{ $job->title }}</h2>
                                <h5 class="text-muted">{{ $job->employer->company_name }}</h5>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary">{{ ucfirst($job->job_type) }}</span>
                                <span class="badge bg-secondary">{{ ucfirst($job->experience_level) }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Job Description</h5>
                            {!! $job->description !!}
                        </div>

                        <div class="mb-4">
                            <h5>Requirements</h5>
                            {!! $job->requirements !!}
                        </div>

                        <div class="mb-4">
                            <h5>Skills</h5>
                            <div>
                                @foreach (explode(',', $job->skills) as $skill)
                                    <span class="badge bg-light text-dark">{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Job Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $job->location }}
                                    </p>
                                    <p><i class="fas fa-money-bill-wave"></i> <strong>Salary:</strong> {{ $job->salary }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><i class="fas fa-clock"></i> <strong>Posted:</strong>
                                        {{ $job->created_at->diffForHumans() }}</p>
                                    <p><i class="fas fa-calendar-times"></i> <strong>Deadline:</strong>
                                        {{ $job->deadline->format('F d, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            @if (Auth::user()->role !== 'employer')
                                <button class="btn btn-primary">Apply Now</button>
                            @endif

                            @if (Auth::user()->role === 'employer' && Auth::user()->employer->id === $job->employer_id)
                                <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Job
                                </a>
                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100"
                                        onclick="return confirm('Are you sure you want to delete this job?')">
                                        <i class="fas fa-trash"></i> Delete Job
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary">Back to Jobs</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">About Company</h5>
                        <p class="card-text"><strong>{{ $job->employer->company_name }}</strong></p>
                        <p class="card-text">{{ $job->employer->company_description }}</p>
                        <p class="employers-email">
                            <i class="fas fa-envelope"></i>
                            @if ($job->employer && $job->employer->user)
                                <a href="mailto:{{ $job->employer->user->email }}"
                                    class="text-decoration-none text-dark">{{ $job->employer->user->email }}</a>
                            @else
                                <span>Email not available</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Similar Jobs</h5>
                        <div class="list-group">
                            @foreach ($similarJobs as $similarJob)
                                <a href="{{ route('jobs.show', $similarJob->id) }}"
                                    class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $similarJob->title }}</h6>
                                        <small class="text-muted">{{ $similarJob->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">{{ $similarJob->employer->company_name }}</p>
                                    <small class="text-muted">{{ $similarJob->location }}</small>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .badge {
            padding: 0.5em 1em;
            border-radius: 20px;
        }

        .list-group-item {
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }
    </style>
@endpush
