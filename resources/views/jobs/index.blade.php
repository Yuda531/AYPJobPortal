@extends('layouts.app2')

@section('content')
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row pt-3">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Filters</h5>
                        <form action="#" method="GET">
                            <div class="mb-3">
                                <label for="job_type" class="form-label">Job Type</label>
                                <select name="job_type" id="job_type" class="form-select">
                                    <option value="">All Types</option>
                                    <option value="full-time">Full Time</option>
                                    <option value="part-time">Part Time</option>
                                    <option value="internship">Internship</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="experience_level" class="form-label">Experience Level</label>
                                <select name="experience_level" id="experience_level" class="form-select">
                                    <option value="">All Levels</option>
                                    <option value="no_experience">No Experience</option>
                                    <option value="entry">Entry Level</option>
                                    <option value="mid">Mid Level</option>
                                    <option value="senior">Senior Level</option>
                                    <option value="expert">Expert Level</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Job Listings</h2>
                    @if ($isEmployer)
                        <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Post a Job
                        </a>
                    @endif
                </div>

                @forelse($jobs as $job)
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title">{{ $job->title }}</h4>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $job->employer->company_name }}</h6>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-primary">{{ ucfirst($job->job_type) }}</span>
                                    <span class="badge bg-secondary">{{ ucfirst($job->experience_level) }}</span>
                                </div>
                            </div>

                            <p class="card-text mt-3">{{ Str::limit(strip_tags($job->description), 200) }}</p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span class="text-muted"><i class="fas fa-map-marker-alt"></i>
                                        {{ $job->location }}</span>
                                    <span class="text-muted ms-3"><i class="fas fa-money-bill-wave"></i>
                                        {{ $job->salary }}</span>
                                </div>
                                <div>
                                    <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-primary">View
                                        Details</a>
                                    @if ($isEmployer && Auth::user()->employer->id === $job->employer_id)
                                        <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-outline-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete this job?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            @foreach (explode(',', $job->skills) as $skill)
                                <span class="badge bg-light text-dark">{{ trim($skill) }}</span>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        No jobs found. @if ($isEmployer)
                            <a href="{{ route('jobs.create') }}">Post a job</a> now!
                        @endif
                    </div>
                @endforelse
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

        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .badge {
            padding: 0.5em 1em;
            border-radius: 20px;
        }
    </style>
@endpush
