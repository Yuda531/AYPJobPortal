<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <i class="fas fa-briefcase me-2"></i>
            <span>AYPJob</span>
        </a>

        <!-- Search Bar -->
        <div class="search-container ms-3 flex-grow-1">
            <div class="input-group">
                <span class="input-group-text bg-light border-0">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" class="form-control border-0 bg-light"
                    placeholder="Search jobs, companies, or people">
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link d-flex flex-column align-items-center" href="{{ route('dashboard') }}">
                        <i class="fas fa-home fs-5"></i>
                        <small>Home</small>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex flex-column align-items-center" href="{{ route('jobs.index') }}">
                        <i class="fas fa-briefcase fs-5"></i>
                        <small>Jobs</small>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex flex-column align-items-center" href="{{ route('network.index') }}">
                        <i class="fas fa-users fs-5"></i>
                        <small>Network</small>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex flex-column align-items-center" href="#"
                        id="profileDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle fs-5"></i>
                        <small>Me</small>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li>
                            {{-- <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user me-2"></i>View Profile
                            </a> --}}
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user me-2"></i>View Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .search-container {
        max-width: 500px;
    }

    .search-container .form-control {
        border-radius: 0.25rem;
    }

    .search-container .input-group-text {
        border-radius: 0.25rem 0 0 0.25rem;
    }

    .nav-link {
        color: #666;
        padding: 0.5rem 1rem;
    }

    .nav-link:hover {
        color: #0a66c2;
    }

    .nav-link.active {
        color: #0a66c2;
    }

    .dropdown-menu {
        min-width: 200px;
    }
</style>
