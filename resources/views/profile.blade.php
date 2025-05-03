@extends('layouts.app2')

@section('content')
    <div class="container mt-3">
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
    </div>


    <div class="container py-4">
        <!-- Cover Photo Section -->
        <div class="card mb-4">
            <div class="position-relative">
                <img src="https://picsum.photos/1200/300?random=1" class="img-fluid w-100"
                    style="height: 300px; object-fit: cover;" alt="Cover Photo">
                <div class="position-absolute bottom-0 start-0 p-4 mb-5">
                    @if ($user->profile_picture)
                        <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_picture) }}"
                            class="rounded-circle border border-4 border-white mb-3"
                            style="width: 150px; height: 150px; object-fit: fill;" alt="Profile Picture">
                    @else
                        <img src="{{ asset('storage/avatar_default.png') }}"
                            class="rounded-circle border border-4 border-white mb-3"
                            style="width: 150px; height: 150px; object-fit: cover;" alt="Profile Picture">
                    @endif
                </div>
                <div class="position-absolute bottom-0 end-0 p-4">
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fas fa-pencil-alt me-2"></i>Edit Profile
                    </button>
                </div>
                <div class="mt-5 mb-3 container">
                    <h2 class="mb-1 ms-4 mt-5" id="profileName">{{ $user->name }}</h2>
                    <p class="mb-0 ms-4" id="profileTitle">
                        @if ($user->role === 'job_seeker')
                            {{ $profile->title ?? 'No title set' }}
                        @else
                            <strong> {{ $profile->title ?? 'No title set' }} </strong> at <strong>
                                {{ $profile->company_name ?? 'No company name set' }} </strong>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Profile Info Section -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-8">
                <!-- Bio Section -->
                <div class="card mb-4">
                    <div class="card-body ms-3">
                        <h4 class="card-title mb-3">Bio</h4>
                        <p class="card-text" id="profileBio">{{ $profile->bio ?? 'No bio set' }}</p>
                    </div>
                </div>

                @if ($user->role === 'employer')
                    <!-- Company Description Section -->
                    <div class="card mb-4">
                        <div class="card-body ms-3">
                            <h4 class="card-title mb-3">{{ $profile->company_name ?? 'No company name set' }}</h4>
                            <p class="card-text" id="companyDescription">
                                {{ $profile->company_description ?? 'No company description set' }}</p>
                        </div>
                    </div>
                @endif

                <!-- Experience Section -->
                <div class="card mb-4">
                    <div class="card-body ms-3">
                        <h4 class="card-title mb-3">Experience</h4>
                        <div class="experience-item mb-3">
                            <h5 class="mb-1">Senior Software Engineer</h5>
                            <p class="text-muted mb-1">Tech Solutions Inc.</p>
                            <p class="text-muted small">Jan 2020 - Present</p>
                            <p class="mb-0">Leading development of enterprise applications using Laravel and Vue.js.</p>
                        </div>
                    </div>
                </div>

                <!-- Education Section -->
                <div class="card mb-4">
                    <div class="card-body ms-3">
                        <h4 class="card-title mb-3">Education</h4>
                        <div class="education-item">
                            <h5 class="mb-1">Bachelor of Computer Science</h5>
                            <p class="text-muted mb-1">University of Technology</p>
                            <p class="text-muted small">2015 - 2019</p>
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="card mb-4">
                    <div class="card-body ms-3">
                        <h4 class="card-title mb-3">Skills</h4>
                        <div class="d-flex flex-wrap gap-2">
                            @if ($profile && $profile->skills)
                                @foreach (explode(',', $profile->skills) as $skill)
                                    <span class="badge bg-light text-dark p-2">{{ trim($skill) }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">No skills added</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-4">
                <!-- Contact Info -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Contact Information</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="fas fa-envelope me-2 text-muted"></i>
                                <span id="profileEmail">{{ $user->email }}</span>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-phone me-2 text-muted"></i>
                                <span id="profilePhone">{{ $profile->phone ?? 'No phone number' }}</span>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                <span id="profileLocation">{{ $profile->location ?? 'No location set' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Languages -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Languages</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">English - Native</li>
                            <li class="mb-2">Indonesia - Professional</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="profileForm" action="{{ route('profile.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Basic Information -->
                        <div class="mb-4">
                            <h6 class="mb-3">Basic Information</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        value="{{ explode(' ', $user->name)[0] }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="{{ implode(' ', array_slice(explode(' ', $user->name), 1)) }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">
                                    @if ($user->role === 'job_seeker')
                                        Title
                                    @else
                                        Position
                                    @endif
                                </label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $profile->title ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" rows="4">{{ $profile->bio ?? '' }}</textarea>
                            </div>

                            @if ($user->role === 'employer')
                                <div class="mb-3">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                        value="{{ $profile->company_name ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="company_description" class="form-label">Company Description</label>
                                    <textarea class="form-control" id="company_description" name="company_description" rows="4">{{ $profile->company_description ?? '' }}</textarea>
                                </div>
                            @endif
                        </div>

                        <!-- Contact Information -->
                        <div class="mb-4">
                            <h6 class="mb-3">Contact Information</h6>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    value="{{ $profile->phone ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    value="{{ $profile->location ?? '' }}">
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="mb-4">
                            <h6 class="mb-3">Skills</h6>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="skills" name="skills"
                                    value="{{ $profile->skills ?? '' }}">
                                <small class="text-muted">Separate skills with commas</small>
                            </div>
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-4">
                            <h6 class="mb-3">Profile Picture</h6>
                            <div class="mb-3">
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture"
                                    accept="image/*" onchange="validateImageSize(this)">
                                <div class="form-text text-muted">
                                    <ul class="mb-0">
                                        <li>Maximum file size: 2MB</li>
                                        <li>Supported formats: JPG, JPEG, PNG</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="profileForm" class="btn btn-primary" id="button-submit">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-weight: normal;
            padding: 8px 12px;
        }

        .experience-item,
        .education-item {
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
        }

        .experience-item:last-child,
        .education-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
    </style>

    <script>
        function validateImageSize(input) {
            if (input.files && input.files[0]) {
                const fileSize = input.files[0].size / 1024 / 1024;
                if (fileSize > 2) {
                    alert('File size must be less than 2MB');
                    input.value = '';
                    return;
                }

                img.src = URL.createObjectURL(input.files[0]);
            }
        }
    </script>
@endsection
