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
                        <strong>Terjadi kesalahan:</strong><br>
                        @foreach ($errors->all() as $error)
                            • {{ $error }}<br>
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

                        <form method="POST" action="{{ route('register.action') }}" id="registerForm" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required autofocus
                                    minlength="3" maxlength="50">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="form-text">Minimal 3 karakter, maksimal 50 karakter</div>
                                @enderror
                                <div class="invalid-feedback" id="name-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="form-text">Contoh: user@example.com</div>
                                @enderror
                                <div class="invalid-feedback" id="email-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror"
                                        id="password" name="password" required minlength="6" maxlength="32">
                                    <i class="fas fa-eye toggle-password" data-target="password"
                                        style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"></i>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <div class="form-text">Minimal 6 karakter, maksimal 32 karakter</div>
                                @enderror
                                <div class="invalid-feedback" id="password-error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password <span
                                        class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation" required>
                                    <i class="fas fa-eye toggle-password" data-target="password_confirmation"
                                        style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"></i>
                                </div>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="password_confirmation-error"></div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">I want to join as <span class="text-danger">*</span></label>
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
                                        <label class="form-check-label w-100 p-3 text-center cursor-pointer"
                                            for="employer" style="border: 1px solid #ddd; border-radius: 4px;">
                                            <i class="fas fa-building me-2"></i>Employer
                                        </label>
                                    </div>
                                </div>
                                @error('role')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <div class="text-danger small mt-1" id="role-error" style="display: none;"></div>
                            </div>

                            <!-- Employer additional fields -->
                            <div id="employer-fields" style="display: none;">
                                <div class="mb-3">
                                    <label for="company_name" class="form-label">Company Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                        id="company_name" name="company_name" value="{{ old('company_name') }}"
                                        minlength="3" maxlength="100">
                                    @error('company_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="form-text">Minimal 3 karakter, maksimal 100 karakter</div>
                                    @enderror
                                    <div class="invalid-feedback" id="company_name-error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="company_description" class="form-label">Company Description <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('company_description') is-invalid @enderror" id="company_description"
                                        name="company_description" rows="6" minlength="10" maxlength="1000">{{ old('company_description') }}</textarea>
                                    @error('company_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="form-text">Minimal 10 karakter, maksimal 1000 karakter</div>
                                    @enderror
                                    <div class="invalid-feedback" id="company_description-error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone') }}"
                                        pattern="^(\+62|62|0)8[1-9][0-9]{6,10}$" minlength="10" maxlength="15">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="form-text">Format: 08xxxxxxxxxx atau +62xxxxxxxxx</div>
                                    @enderror
                                    <div class="invalid-feedback" id="phone-error"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Location <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        id="location" name="location" value="{{ old('location') }}" minlength="3"
                                        maxlength="100">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <div class="form-text">Minimal 3 karakter, maksimal 100 karakter</div>
                                    @enderror
                                    <div class="invalid-feedback" id="location-error"></div>
                                </div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"
                                        id="loadingSpinner" style="display: none;"></span>
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

        .form-control.is-invalid {
            border-color: #dc3545;
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

        .text-danger {
            color: #dc3545 !important;
        }

        .was-validated .form-control:invalid {
            border-color: #dc3545;
        }

        .was-validated .form-control:valid {
            border-color: #198754;
        }

        .position-relative .form-control.is-valid,
        .position-relative .form-control.is-invalid {
            padding-right: 3.5rem;
            background-position: right 2.8rem center;
            /* icon validasi di antara input dan icon mata */
        }

        .position-relative .toggle-password {
            right: 0.7rem;
            /* icon mata lebih ke kanan */
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
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
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
                const isEmployer = employerRadio.checked;

                employerFields.style.display = isEmployer ? '' : 'none';

                // Set required attribute for employer fields
                const employerInputs = employerFields.querySelectorAll('input, textarea');
                employerInputs.forEach(input => {
                    if (isEmployer) {
                        input.setAttribute('required', '');
                    } else {
                        input.removeAttribute('required');
                        input.classList.remove('is-invalid');
                        // Clear previous validation errors
                        const errorDiv = document.getElementById(input.name + '-error');
                        if (errorDiv) errorDiv.textContent = '';
                    }
                });
            }

            document.getElementById('job_seeker').addEventListener('change', toggleEmployerFields);
            document.getElementById('employer').addEventListener('change', toggleEmployerFields);

            // On page load, set correct state
            toggleEmployerFields();

            // Client-side validation
            const form = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');
            const loadingSpinner = document.getElementById('loadingSpinner');

            // Real-time validation functions
            function validateField(field) {
                const value = field.value.trim();
                const fieldName = field.name;
                let isValid = true;
                let errorMessage = '';

                // Clear previous errors
                field.classList.remove('is-invalid', 'is-valid');
                const errorDiv = document.getElementById(fieldName + '-error');
                if (errorDiv) errorDiv.textContent = '';

                switch (fieldName) {
                    case 'name':
                        if (!value) {
                            errorMessage = 'Full Name wajib diisi.';
                            isValid = false;
                        } else if (value.length < 3) {
                            errorMessage = 'Full Name minimal 3 karakter.';
                            isValid = false;
                        } else if (value.length > 50) {
                            errorMessage = 'Full Name maksimal 50 karakter.';
                            isValid = false;
                        }
                        break;

                    case 'email':
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!value) {
                            errorMessage = 'Email wajib diisi.';
                            isValid = false;
                        } else if (!emailRegex.test(value)) {
                            errorMessage = 'Format email tidak valid.';
                            isValid = false;
                        }
                        break;

                    case 'password':
                        if (!value) {
                            errorMessage = 'Password wajib diisi.';
                            isValid = false;
                        } else if (value.length < 6) {
                            errorMessage = 'Password minimal 6 karakter.';
                            isValid = false;
                        } else if (value.length > 32) {
                            errorMessage = 'Password maksimal 32 karakter.';
                            isValid = false;
                        }
                        break;

                    case 'password_confirmation':
                        const password = document.getElementById('password').value;
                        if (!value) {
                            errorMessage = 'Konfirmasi password wajib diisi.';
                            isValid = false;
                        } else if (value !== password) {
                            errorMessage = 'Konfirmasi password tidak cocok.';
                            isValid = false;
                        }
                        break;

                    case 'company_name':
                        if (document.getElementById('employer').checked) {
                            if (!value) {
                                errorMessage = 'Company Name wajib diisi untuk employer.';
                                isValid = false;
                            } else if (value.length < 3) {
                                errorMessage = 'Company Name minimal 3 karakter.';
                                isValid = false;
                            } else if (value.length > 100) {
                                errorMessage = 'Company Name maksimal 100 karakter.';
                                isValid = false;
                            }
                        }
                        break;

                    case 'company_description':
                        if (document.getElementById('employer').checked) {
                            if (!value) {
                                errorMessage = 'Company Description wajib diisi untuk employer.';
                                isValid = false;
                            } else if (value.length < 10) {
                                errorMessage = 'Company Description minimal 10 karakter.';
                                isValid = false;
                            } else if (value.length > 1000) {
                                errorMessage = 'Company Description maksimal 1000 karakter.';
                                isValid = false;
                            }
                        }
                        break;

                    case 'phone':
                        if (document.getElementById('employer').checked) {
                            const phoneRegex = /^(\+62|62|0)8[1-9][0-9]{6,10}$/;
                            if (!value) {
                                errorMessage = 'Phone wajib diisi untuk employer.';
                                isValid = false;
                            } else if (!phoneRegex.test(value)) {
                                errorMessage =
                                    'Format phone tidak valid. Gunakan format: 08xxxxxxxxxx atau +62xxxxxxxxx.';
                                isValid = false;
                            }
                        }
                        break;

                    case 'location':
                        if (document.getElementById('employer').checked) {
                            if (!value) {
                                errorMessage = 'Location wajib diisi untuk employer.';
                                isValid = false;
                            } else if (value.length < 3) {
                                errorMessage = 'Location minimal 3 karakter.';
                                isValid = false;
                            } else if (value.length > 100) {
                                errorMessage = 'Location maksimal 100 karakter.';
                                isValid = false;
                            }
                        }
                        break;
                }

                if (!isValid) {
                    field.classList.add('is-invalid');
                    if (errorDiv) {
                        errorDiv.textContent = errorMessage;
                        errorDiv.style.display = 'block';
                    }
                } else {
                    field.classList.add('is-valid');
                }

                return isValid;
            }

            // Add blur event listeners for real-time validation
            ['name', 'email', 'password', 'password_confirmation', 'company_name', 'company_description', 'phone',
                'location'
            ].forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field) {
                    field.addEventListener('blur', () => validateField(field));
                    field.addEventListener('input', () => {
                        // Clear validation on input
                        field.classList.remove('is-invalid', 'is-valid');
                        const errorDiv = document.getElementById(fieldName + '-error');
                        if (errorDiv) {
                            errorDiv.textContent = '';
                            errorDiv.style.display = 'none';
                        }
                    });
                }
            });

            // Form submission validation
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                let isFormValid = true;

                // Validate all fields
                const requiredFields = ['name', 'email', 'password', 'password_confirmation'];

                // Add employer fields if employer is selected
                if (document.getElementById('employer').checked) {
                    requiredFields.push('company_name', 'company_description', 'phone', 'location');
                }

                requiredFields.forEach(fieldName => {
                    const field = document.getElementById(fieldName);
                    if (field && !validateField(field)) {
                        isFormValid = false;
                    }
                });

                // Check if role is selected
                const roleSelected = document.querySelector('input[name="role"]:checked');
                const roleError = document.getElementById('role-error');

                if (!roleSelected) {
                    isFormValid = false;
                    roleError.textContent = 'Anda harus memilih role (Job Seeker atau Employer).';
                    roleError.style.display = 'block';

                    // Add visual indication to role selection
                    document.querySelectorAll('.form-check-label').forEach(label => {
                        label.style.borderColor = '#dc3545';
                    });
                } else {
                    roleError.style.display = 'none';
                    document.querySelectorAll('.form-check-label').forEach(label => {
                        label.style.borderColor = '#ddd';
                    });
                }

                if (isFormValid) {
                    // Show loading state
                    submitBtn.disabled = true;
                    loadingSpinner.style.display = 'inline-block';
                    submitBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Creating Account...';

                    // Submit the form
                    form.submit();
                } else {
                    // Scroll to first error
                    const firstError = document.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        firstError.focus();
                    }
                }
            });

            // Password confirmation real-time validation
            document.getElementById('password_confirmation').addEventListener('input', function() {
                const password = document.getElementById('password').value;
                const confirmation = this.value;
                const errorDiv = document.getElementById('password_confirmation-error');

                if (confirmation && confirmation !== password) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                    if (errorDiv) {
                        errorDiv.textContent = 'Konfirmasi password tidak cocok.';
                        errorDiv.style.display = 'block';
                    }
                } else if (confirmation && confirmation === password) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                    if (errorDiv) {
                        errorDiv.style.display = 'none';
                    }
                }
            });

            // Character count for textarea
            const companyDescription = document.getElementById('company_description');
            if (companyDescription) {
                const maxLength = 1000;

                // Create character counter
                const counterDiv = document.createElement('div');
                counterDiv.className = 'form-text text-end';
                counterDiv.id = 'char-counter';
                companyDescription.parentNode.insertBefore(counterDiv, companyDescription.nextSibling);

                function updateCharCount() {
                    const currentLength = companyDescription.value.length;
                    counterDiv.textContent = `${currentLength}/${maxLength} karakter`;

                    if (currentLength > maxLength) {
                        counterDiv.classList.add('text-danger');
                        counterDiv.classList.remove('text-muted');
                    } else if (currentLength > maxLength * 0.9) {
                        counterDiv.classList.add('text-warning');
                        counterDiv.classList.remove('text-danger', 'text-muted');
                    } else {
                        counterDiv.classList.add('text-muted');
                        counterDiv.classList.remove('text-danger', 'text-warning');
                    }
                }

                companyDescription.addEventListener('input', updateCharCount);
                updateCharCount(); // Initial count
            }
        });
    </script>
@endsection
