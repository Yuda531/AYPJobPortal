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
                                <h2 class="card-title">Senior PHP Developer</h2>
                                <h5 class="text-muted">Tech Company Inc.</h5>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary">Full Time</span>
                                <span class="badge bg-secondary">Senior</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Job Description</h5>
                            <p>We are looking for an experienced PHP developer to join our team. The ideal candidate will
                                have strong experience with Laravel and modern PHP development practices.</p>
                            <p>Responsibilities:</p>
                            <ul>
                                <li>Develop and maintain web applications using PHP and Laravel</li>
                                <li>Write clean, maintainable, and well-documented code</li>
                                <li>Collaborate with frontend developers to integrate user-facing elements</li>
                                <li>Implement security and data protection measures</li>
                                <li>Optimize application for maximum speed and scalability</li>
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h5>Requirements</h5>
                            <ul>
                                <li>5+ years of experience in PHP development</li>
                                <li>Strong knowledge of Laravel framework</li>
                                <li>Experience with MySQL and database design</li>
                                <li>Understanding of MVC design patterns</li>
                                <li>Familiarity with Git version control</li>
                                <li>Good problem-solving skills</li>
                            </ul>
                        </div>

                        <div class="mb-4">
                            <h5>Skills</h5>
                            <div>
                                <span class="badge bg-light text-dark">PHP</span>
                                <span class="badge bg-light text-dark">Laravel</span>
                                <span class="badge bg-light text-dark">MySQL</span>
                                <span class="badge bg-light text-dark">Git</span>
                                <span class="badge bg-light text-dark">REST API</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Job Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> New York, USA</p>
                                    <p><i class="fas fa-money-bill-wave"></i> <strong>Salary:</strong> $80,000 - $100,000
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><i class="fas fa-clock"></i> <strong>Posted:</strong> 2 days ago</p>
                                    <p><i class="fas fa-calendar-times"></i> <strong>Deadline:</strong> March 31, 2024</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary">Apply Now</button>
                            <a href="#" class="btn btn-outline-secondary">Back to Jobs</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">About Company</h5>
                        <p class="card-text">Tech Company Inc. is a leading technology company specializing in web
                            development and digital solutions. We have been in business for over 10 years and have a team of
                            50+ employees.</p>
                        <p><i class="fas fa-globe"></i> <a href="#">www.techcompany.com</a></p>
                        <p><i class="fas fa-envelope"></i> <a
                                href="mailto:careers@techcompany.com">careers@techcompany.com</a></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Similar Jobs</h5>
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">PHP Developer</h6>
                                    <small class="text-muted">2 days ago</small>
                                </div>
                                <p class="mb-1">Web Solutions Ltd.</p>
                                <small class="text-muted">London, UK</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Backend Developer</h6>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-1">Digital Tech</p>
                                <small class="text-muted">San Francisco, USA</small>
                            </a>
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
