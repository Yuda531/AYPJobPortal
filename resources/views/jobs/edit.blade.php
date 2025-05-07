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

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Job</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('jobs.update', $job->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="title" class="form-label">Job Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" placeholder="e.g. Senior PHP Developer"
                                    value="{{ old('title', $job->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Job Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="5" placeholder="Describe the job responsibilities and requirements...">{{ old('description', strip_tags($job->description)) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="requirements" class="form-label">Requirements</label>
                                <textarea class="form-control @error('requirements') is-invalid @enderror" id="requirements" name="requirements"
                                    rows="5" placeholder="List the required skills and qualifications... (Press Enter for new line)">{{ old('requirements', strip_tags($job->requirements)) }}</textarea>
                                <div class="form-text">Press Enter for each new requirement</div>
                                @error('requirements')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        id="location" name="location" placeholder="e.g. Jakarta, Indonesia"
                                        value="{{ old('location', $job->location) }}">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="text" class="form-control @error('salary') is-invalid @enderror"
                                        id="salary" name="salary" placeholder="e.g. $800 - $1000"
                                        value="{{ old('salary', $job->salary) }}">
                                    @error('salary')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="job_type" class="form-label">Job Type</label>
                                    <select class="form-select @error('job_type') is-invalid @enderror" id="job_type"
                                        name="job_type">
                                        <option value="full-time"
                                            {{ old('job_type', $job->job_type) == 'full-time' ? 'selected' : '' }}>Full
                                            Time</option>
                                        <option value="part-time"
                                            {{ old('job_type', $job->job_type) == 'part-time' ? 'selected' : '' }}>Part
                                            Time</option>
                                        <option value="internship"
                                            {{ old('job_type', $job->job_type) == 'internship' ? 'selected' : '' }}>
                                            Internship</option>
                                    </select>
                                    @error('job_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="experience_level" class="form-label">Experience Level</label>
                                    <select class="form-select @error('experience_level') is-invalid @enderror"
                                        id="experience_level" name="experience_level">
                                        <option value="no_experience"
                                            {{ old('experience_level', $job->experience_level) == 'no_experience' ? 'selected' : '' }}>
                                            No Experience</option>
                                        <option value="entry"
                                            {{ old('experience_level', $job->experience_level) == 'entry' ? 'selected' : '' }}>
                                            Entry Level</option>
                                        <option value="mid"
                                            {{ old('experience_level', $job->experience_level) == 'mid' ? 'selected' : '' }}>
                                            Mid Level</option>
                                        <option value="senior"
                                            {{ old('experience_level', $job->experience_level) == 'senior' ? 'selected' : '' }}>
                                            Senior Level</option>
                                        <option value="expert"
                                            {{ old('experience_level', $job->experience_level) == 'expert' ? 'selected' : '' }}>
                                            Expert Level</option>
                                    </select>
                                    @error('experience_level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deadline" class="form-label">Application Deadline</label>
                                <input type="date" class="form-control @error('deadline') is-invalid @enderror"
                                    id="deadline" name="deadline"
                                    value="{{ old('deadline', $job->deadline->format('Y-m-d')) }}">
                                @error('deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="skills" class="form-label">Required Skills</label>
                                <input type="text" class="form-control @error('skills') is-invalid @enderror"
                                    id="skills" name="skills" placeholder="e.g. PHP, Laravel, MySQL, JavaScript"
                                    value="{{ old('skills', $job->skills) }}">
                                <div class="form-text">Separate skills with commas</div>
                                @error('skills')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Update Job</button>
                                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
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

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
@endpush
