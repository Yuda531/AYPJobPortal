<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AYPJob - {{ $title ?? 'Find Your Dream Job' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0a66c2;
            --secondary-color: #004182;
            --accent-color: #70b5f9;
            --text-color: #000000e6;
            --text-secondary: #666666;
            --background-color: #f3f2ef;
            --card-background: #ffffff;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .navbar {
            background-color: var(--card-background) !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-weight: 600;
        }

        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-outline-light {
            color: var(--text-color);
            border-color: var(--text-secondary);
        }

        .btn-outline-light:hover {
            background-color: var(--background-color);
            color: var(--primary-color);
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=2069&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
            position: relative;
        }

        .job-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            background: var(--card-background);
            border-radius: 8px;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .category-card {
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: var(--card-background);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .category-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .search-box {
            background: var(--card-background);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .company-logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 1rem;
        }

        .stats-section {
            background: var(--card-background);
            color: var(--text-color);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .testimonial-card {
            background: var(--card-background);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .testimonial-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .company-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            background: var(--card-background);
            border-radius: 8px;
        }

        .company-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .company-logo {
            width: 120px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .company-card:hover .company-logo {
            transform: scale(1.1);
        }

        #companiesCarousel .carousel-control-prev,
        #companiesCarousel .carousel-control-next,
        #testimonialsCarousel .carousel-control-prev,
        #testimonialsCarousel .carousel-control-next {
            width: 5%;
            opacity: 0.8;
        }

        #companiesCarousel .carousel-control-prev-icon,
        #companiesCarousel .carousel-control-next-icon,
        #testimonialsCarousel .carousel-control-prev-icon,
        #testimonialsCarousel .carousel-control-next-icon {
            background-color: var(--primary-color);
            border-radius: 50%;
            padding: 1.5rem;
            background-size: 1.5rem;
        }

        #companiesCarousel .carousel-control-prev:hover,
        #companiesCarousel .carousel-control-next:hover,
        #testimonialsCarousel .carousel-control-prev:hover,
        #testimonialsCarousel .carousel-control-next:hover {
            opacity: 1;
        }

        .carousel {
            padding: 1rem 0;
        }

        .carousel-inner {
            padding: 1rem;
        }

        footer {
            background-color: var(--card-background) !important;
            color: var(--text-color) !important;
            border-top: 1px solid rgba(0, 0, 0, 0.08);
        }

        footer a {
            color: var(--text-color) !important;
        }

        footer a:hover {
            color: var(--primary-color) !important;
            text-decoration: none;
        }

        .text-muted {
            color: var(--text-secondary) !important;
        }
    </style>
</head>

<body>
    @include('components.navbar')

    @yield('content')

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
