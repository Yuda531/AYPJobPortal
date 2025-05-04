@extends('layouts.app2')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Post a New Job</h4>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Job Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="e.g. Senior PHP Developer">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Job Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5"
                                    placeholder="Describe the job responsibilities and requirements..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="requirements" class="form-label">Requirements</label>
                                <textarea class="form-control" id="requirements" name="requirements" rows="5"
                                    placeholder="List the required skills and qualifications..."></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location"
                                        placeholder="e.g. Jakarta, Indonesia">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="text" class="form-control" id="salary" name="salary"
                                        placeholder="e.g. $800 - $1000">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="job_type" class="form-label">Job Type</label>
                                    <select class="form-select" id="job_type" name="job_type">
                                        <option value="full-time">Full Time</option>
                                        <option value="part-time">Part Time</option>
                                        <option value="contract">Contract</option>
                                        <option value="internship">Internship</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="experience_level" class="form-label">Experience Level</label>
                                    <select class="form-select" id="experience_level" name="experience_level">
                                        <option value="no_experience">No Experience</option>
                                        <option value="entry">Entry Level</option>
                                        <option value="mid">Mid Level</option>
                                        <option value="senior">Senior Level</option>
                                        <option value="expert">Expert Level</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="deadline" class="form-label">Application Deadline</label>
                                <input type="date" class="form-control" id="deadline" name="deadline">
                            </div>

                            <div class="mb-3">
                                <label for="skills" class="form-label">Required Skills</label>
                                <input type="text" class="form-control" id="skills" name="skills"
                                    placeholder="e.g. PHP, Laravel, MySQL, JavaScript">
                                <div class="form-text">Separate skills with commas</div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Post Job</button>
                                <a href="#" class="btn btn-outline-secondary">Cancel</a>
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
