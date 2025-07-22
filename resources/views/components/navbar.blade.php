<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <i class="fas fa-briefcase me-2"></i>
            <span>AYPJob</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @php
                    $onHome = request()->routeIs('home') || request()->is('/');
                @endphp
                <li class="nav-item">
                    <a class="nav-link" href="{{ $onHome ? '#jobs' : route('home', [], false) . '#jobs' }}"><i
                            class="fas fa-search me-1"></i>Find Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ $onHome ? '#categories' : route('home', [], false) . '#categories' }}"><i
                            class="fas fa-list me-1"></i>Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ $onHome ? '#companies' : route('home', [], false) . '#companies' }}"><i
                            class="fas fa-building me-1"></i>Companies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ $onHome ? '#testimonials' : route('home', [], false) . '#testimonials' }}"><i
                            class="fas fa-comments me-1"></i>Testimonials</a>
                </li>
            </ul>
            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn btn-outline-primary p-2 me-2"><i
                        class="fas fa-sign-in-alt me-1"></i>Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary p-2"><i
                        class="fas fa-user-plus me-1"></i>Register</a>
            </div>
        </div>
    </div>
</nav>
