@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Alert Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold" style="color: var(--primary-color)">Join AYPJob</h2>
                            <p class="text-muted">Create your account to start your journey</p>
                        </div>

                        <form method="POST" action="{{ route('register.action') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror"
                                        id="password" name="password" required>
                                    <i class="fas fa-eye toggle-password" data-target="password"
                                        style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"></i>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation" required>
                                    <i class="fas fa-eye toggle-password" data-target="password_confirmation"
                                        style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"></i>
                                </div>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">I want to join as</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check flex-grow-1 p-0">
                                        <input type="radio" name="role" id="job_seeker" value="job_seeker"
                                            {{ old('role') == 'job_seeker' ? 'checked' : '' }} class="d-none" required>
                                        <label class="form-check-label w-100 p-3 text-center cursor-pointer"
                                            for="job_seeker" style="border: 1px solid #ddd; border-radius: 4px;">
                                            <i class="fas fa-user-tie me-2"></i>Job Seeker
                                        </label>
                                    </div>
                                    <div class="form-check flex-grow-1 p-0">
                                        <input type="radio" name="role" id="employer" value="employer"
                                            {{ old('role') == 'employer' ? 'checked' : '' }} class="d-none">
                                        <label class="form-check-label w-100 p-3 text-center cursor-pointer" for="employer"
                                            style="border: 1px solid #ddd; border-radius: 4px;">
                                            <i class="fas fa-building me-2"></i>Employer
                                        </label>
                                    </div>
                                </div>
                                @error('role')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Employer additional fields -->
                            <div id="employer-fields" style="display: none;">
                                <div class="mb-3">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                        id="company_name" name="company_name" value="{{ old('company_name') }}">
                                    @error('company_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="company_description" class="form-label">Company Description</label>
                                    <textarea class="form-control @error('company_description') is-invalid @enderror" id="company_description"
                                        name="company_description" rows="2">{{ old('company_description') }}</textarea>
                                    @error('company_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        id="location" name="location" value="{{ old('location') }}">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Create Account
                                </button>
                            </div>

                            <div class="text-center">
                                <p class="mb-0">Already have an account?
                                    <a href="{{ route('login') }}" class="text-decoration-none"
                                        style="color: var(--primary-color)">
                                        Sign in
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border: none;
            border-radius: 8px;
            background: var(--card-background);
        }

        .form-control {
            border-radius: 4px;
            padding: 0.75rem;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(10, 102, 194, 0.25);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .form-check:hover {
            border-color: var(--primary-color);
        }

        .form-check-input:checked+.form-check-label {
            color: var(--primary-color);
        }

        .btn-primary {
            padding: 0.75rem;
            font-weight: 600;
        }

        .form-check-label {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .form-check-label:hover {
            border-color: var(--primary-color) !important;
            background-color: rgba(10, 102, 194, 0.05);
        }

        input[type="radio"]:checked+.form-check-label {
            border-color: var(--primary-color) !important;
            background-color: rgba(10, 102, 194, 0.1);
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .d-flex.gap-3 {
                flex-direction: column;
                gap: 1rem !important;
            }

            .form-check-label {
                padding: 1rem !important;
            }
        }
    </style>

    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const target = document.getElementById(this.getAttribute('data-target'));
                const type = target.getAttribute('type') === 'password' ? 'text' : 'password';
                target.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });

        // Show/hide employer fields based on role selection
        function toggleEmployerFields() {
            const employerFields = document.getElementById('employer-fields');
            const employerRadio = document.getElementById('employer');
            if (employerRadio.checked) {
                employerFields.style.display = '';
            } else {
                employerFields.style.display = 'none';
            }
        }

        document.getElementById('job_seeker').addEventListener('change', toggleEmployerFields);
        document.getElementById('employer').addEventListener('change', toggleEmployerFields);
        // On page load, set correct state
        toggleEmployerFields();
    </script>
@endsection
