@extends('layouts.app2')

@section('content')
    <div class="container py-4">
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
                                    <option value="contract">Contract</option>
                                    <option value="internship">Internship</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="experience_level" class="form-label">Experience Level</label>
                                <select name="experience_level" id="experience_level" class="form-select">
                                    <option value="">All Levels</option>
                                    <option value="entry">Entry Level</option>
                                    <option value="mid">Mid Level</option>
                                    <option value="senior">Senior Level</option>
                                    <option value="expert">Expert Level</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="skills" class="form-label">Skills</label>
                                <select name="skills[]" id="skills" class="form-select" multiple>
                                    <option value="1">PHP</option>
                                    <option value="2">Laravel</option>
                                    <option value="3">JavaScript</option>
                                    <option value="4">React</option>
                                    <option value="5">MySQL</option>
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
                    <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Post a Job
                    </a>
                </div>

                <!-- Dummy Job Listings -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">Senior PHP Developer</h4>
                                <h6 class="card-subtitle mb-2 text-muted">Tech Company Inc.</h6>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary">Full Time</span>
                                <span class="badge bg-secondary">Senior</span>
                            </div>
                        </div>

                        <p class="card-text mt-3">We are looking for an experienced PHP developer to join our team...</p>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <span class="text-muted"><i class="fas fa-map-marker-alt"></i> New York, USA</span>
                                <span class="text-muted ms-3"><i class="fas fa-money-bill-wave"></i> $80,000 -
                                    $100,000</span>
                            </div>
                            <div>
                                <a href="{{ route('jobs.show', 1) }}" class="btn btn-outline-primary">View Details</a>
                            </div>
                        </div>

                        <div class="mt-3">
                            <span class="badge bg-light text-dark">PHP</span>
                            <span class="badge bg-light text-dark">Laravel</span>
                            <span class="badge bg-light text-dark">MySQL</span>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">Frontend Developer</h4>
                                <h6 class="card-subtitle mb-2 text-muted">Web Solutions Ltd.</h6>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary">Full Time</span>
                                <span class="badge bg-secondary">Mid</span>
                            </div>
                        </div>

                        <p class="card-text mt-3">Join our frontend team to build amazing user interfaces...</p>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <span class="text-muted"><i class="fas fa-map-marker-alt"></i> London, UK</span>
                                <span class="text-muted ms-3"><i class="fas fa-money-bill-wave"></i> £50,000 -
                                    £70,000</span>
                            </div>
                            <div>
                                <a href="{{ route('jobs.show', 2) }}" class="btn btn-outline-primary">View Details</a>
                            </div>
                        </div>

                        <div class="mt-3">
                            <span class="badge bg-light text-dark">JavaScript</span>
                            <span class="badge bg-light text-dark">React</span>
                            <span class="badge bg-light text-dark">CSS</span>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
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
