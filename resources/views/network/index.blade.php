@extends('layouts.app2')

@section('content')
    <div class="container container-bg py-4">
        <div class="row pt-3">
            <!-- Left Sidebar -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Network Stats</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-user-friends me-2"></i>
                                <span>Connections: {{ $users->total() }}</span>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-building me-2"></i>
                                <span>Companies: {{ $companies->count() }}</span>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-globe me-2"></i>
                                <span>Countries: 10+</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Manage Network</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    <i class="fas fa-user-plus me-2"></i>
                                    <span>Invite Connections</span>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    <i class="fas fa-users me-2"></i>
                                    <span>People You May Know</span>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    <i class="fas fa-building me-2"></i>
                                    <span>Companies to Follow</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Your Network</h5>

                        <!-- Search Bar -->
                        <form action="{{ route('network.index') }}" method="GET" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search your network..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>

                        <div class="row">
                            @forelse($users as $user)
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                @if ($user->profile_picture)
                                                    <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_picture) }}"
                                                        class="rounded-circle me-3"
                                                        style="width: 50px; height: 50px; object-fit: cover;"
                                                        alt="{{ $user->name }}">
                                                @else
                                                    <img src="{{ asset('storage/avatar_default.png') }}"
                                                        class="rounded-circle me-3"
                                                        style="width: 50px; height: 50px; object-fit: cover;"
                                                        alt="{{ $user->name }}">
                                                @endif
                                                <div>
                                                    <a href="{{ route('profile.show', $user) }}"
                                                        class="text-decoration-none">
                                                        <h6 class="mb-1 text-dark">{{ $user->name }}</h6>
                                                    </a>
                                                    <p class="text-muted small mb-0">
                                                        @if ($user->role === 'job_seeker')
                                                            {{ $user->jobSeeker->title ?? 'Job Seeker' }}
                                                        @else
                                                            {{ $user->employer->title ?? 'Employer' }} at
                                                            {{ $user->employer->company_name ?? 'Company' }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-user-plus me-1"></i> Connect
                                                </button>
                                                <button class="btn btn-outline-secondary btn-sm">
                                                    <i class="fas fa-envelope me-1"></i> Message
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        No users found in your network.
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $users->withQueryString()->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">People You May Know</h5>
                        @foreach ($suggestedUsers as $user)
                            <div class="d-flex align-items-center mb-3">
                                @if ($user->profile_picture)
                                    <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_picture) }}"
                                        class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;"
                                        alt="{{ $user->name }}">
                                @else
                                    <img src="{{ asset('storage/avatar_default.png') }}" class="rounded-circle me-3"
                                        style="width: 40px; height: 40px; object-fit: cover;" alt="{{ $user->name }}">
                                @endif
                                <div class="flex-grow-1">
                                    <a href="{{ route('profile.show', $user) }}" class="text-decoration-none">
                                        <h6 class="mb-1 text-dark">{{ $user->name }}</h6>
                                    </a>
                                    <p class="text-muted small mb-0">
                                        @if ($user->role === 'job_seeker')
                                            {{ $user->jobSeeker->title ?? 'Job Seeker' }}
                                        @else
                                            {{ $user->employer->title ?? 'Employer' }}
                                        @endif
                                    </p>
                                </div>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Companies to Follow</h5>
                        @foreach ($companies as $company)
                            <div class="d-flex align-items-center mb-3">
                                @if ($company->user->profile_picture)
                                    <img src="data:image/jpeg;base64,{{ base64_encode($company->user->profile_picture) }}"
                                        class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;"
                                        alt="{{ $company->company_name }}">
                                @else
                                    <img src="{{ asset('storage/avatar_default.png') }}" class="rounded-circle me-3"
                                        style="width: 40px; height: 40px; object-fit: cover;"
                                        alt="{{ $company->company_name }}">
                                @endif
                                <div class="flex-grow-1">
                                    <a href="{{ route('profile.show', $company->user) }}" class="text-decoration-none">
                                        <h6 class="mb-1 text-dark">{{ $company->company_name }}</h6>
                                    </a>
                                    <p class="text-muted small mb-0">{{ $company->location }}</p>
                                </div>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .container-bg {
            min-height: 70vh;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .input-group-text {
            border-right: none;
        }

        .form-control {
            border-left: none;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: white;
        }
    </style>
@endsection
