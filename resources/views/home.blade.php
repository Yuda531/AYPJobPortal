@extends('layouts.app')

@section('content')

    <div class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold mb-4">Find Your Dream Job Today</h1>
                    <p class="lead mb-5">Join thousands of companies and job seekers in our professional network</p>
                    <div class="search-box">
                        <form class="row g-3">
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Job title or keywords">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <input type="text" class="form-control" placeholder="Location">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100"><i class="fas fa-search me-2"></i>Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="stats-section py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3">
                    <i class="fas fa-briefcase fa-3x mb-3"></i>
                    <h3 class="display-4 fw-bold">10,000+</h3>
                    <p class="lead">Active Jobs</p>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-building fa-3x mb-3"></i>
                    <h3 class="display-4 fw-bold">5,000+</h3>
                    <p class="lead">Companies</p>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h3 class="display-4 fw-bold">50,000+</h3>
                    <p class="lead">Job Seekers</p>
                </div>
                <div class="col-md-3">
                    <i class="fas fa-check-circle fa-3x mb-3"></i>
                    <h3 class="display-4 fw-bold">95%</h3>
                    <p class="lead">Success Rate</p>
                </div>
            </div>
        </div>
    </div>


    <div class="container my-5" id="jobs">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Featured Jobs</h2>
            <a href="#" class="btn btn-outline-primary">View All Jobs</a>
        </div>
        <div class="row g-4">
            @foreach ([
            ['title' => 'Senior Software Engineer', 'company' => 'Google', 'location' => 'Singapore', 'type' => 'Full Time', 'salary' => '$120k - $200k'],
            ['title' => 'Data Scientist', 'company' => 'Amazon', 'location' => 'Berlin, Germany', 'type' => 'Full Time', 'salary' => '$110k - $180k'],
            ['title' => 'Frontend Developer', 'company' => 'Meta', 'location' => 'London, UK', 'type' => 'Full Time', 'salary' => '$100k - $170k'],
            ['title' => 'DevOps Engineer', 'company' => 'Microsoft', 'location' => 'Jakarta, Indonesia', 'type' => 'Full Time', 'salary' => '$80k - $150k'],
            ['title' => 'iOS Developer', 'company' => 'Uber', 'location' => 'Amsterdam, Netherlands', 'type' => 'Full Time', 'salary' => '$90k - $160k'],
            ['title' => 'Cloud Architect', 'company' => 'IBM', 'location' => 'Sydney, Australia', 'type' => 'Full Time', 'salary' => '$110k - $190k'],
            ['title' => 'Backend Developer', 'company' => 'Netflix', 'location' => 'Seoul, South Korea', 'type' => 'Full Time', 'salary' => '$100k - $170k'],
            ['title' => 'Security Engineer', 'company' => 'Cisco', 'location' => 'Dubai, UAE', 'type' => 'Full Time', 'salary' => '$110k - $180k'],
        ] as $job)
                <div class="col-md-6 col-lg-3">
                    <div class="card job-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title">{{ $job['title'] }}</h5>
                                    <p class="text-muted mb-2">{{ $job['company'] }}</p>
                                </div>
                                <i class="fas fa-bookmark text-primary"></i>
                            </div>
                            <div class="d-flex gap-2 mb-3">
                                <span class="badge bg-light text-dark"><i
                                        class="fas fa-map-marker-alt me-1"></i>{{ $job['location'] }}</span>
                                <span class="badge bg-light text-dark"><i
                                        class="fas fa-clock me-1"></i>{{ $job['type'] }}</span>
                            </div>
                            <p class="text-primary mb-3"><i class="fas fa-dollar-sign me-1"></i>{{ $job['salary'] }}</p>
                            <a href="#" class="btn btn-outline-primary w-100">Apply Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div class="bg-light py-5" id="categories">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Popular Job Categories</h2>
            <div class="row g-4">
                @foreach ([['icon' => 'fa-code', 'title' => 'Technology', 'count' => '2,500+ Jobs'], ['icon' => 'fa-chart-line', 'title' => 'Finance', 'count' => '1,800+ Jobs'], ['icon' => 'fa-paint-brush', 'title' => 'Design', 'count' => '1,200+ Jobs'], ['icon' => 'fa-bullhorn', 'title' => 'Marketing', 'count' => '1,500+ Jobs'], ['icon' => 'fa-graduation-cap', 'title' => 'Education', 'count' => '900+ Jobs'], ['icon' => 'fa-heartbeat', 'title' => 'Healthcare', 'count' => '1,600+ Jobs'], ['icon' => 'fa-building', 'title' => 'Real Estate', 'count' => '1,100+ Jobs'], ['icon' => 'fa-utensils', 'title' => 'Hospitality', 'count' => '800+ Jobs'], ['icon' => 'fa-car', 'title' => 'Automotive', 'count' => '700+ Jobs'], ['icon' => 'fa-shopping-bag', 'title' => 'Retail', 'count' => '1,000+ Jobs'], ['icon' => 'fa-plane', 'title' => 'Travel', 'count' => '600+ Jobs'], ['icon' => 'fa-cogs', 'title' => 'Engineering', 'count' => '1,400+ Jobs']] as $category)
                    <div class="col-md-4 col-lg-2">
                        <div class="card category-card h-100 text-center p-4">
                            <i class="fas {{ $category['icon'] }} feature-icon"></i>
                            <h5>{{ $category['title'] }}</h5>
                            <p class="text-muted mb-0">{{ $category['count'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="container my-5" id="companies">
        <h2 class="text-center fw-bold mb-5">Top Companies</h2>
        <div id="companiesCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @php
                    $companies = [
                        [
                            'name' => 'Google',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg',
                            'jobs' => '1,200+ Jobs',
                        ],
                        [
                            'name' => 'Microsoft',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg',
                            'jobs' => '900+ Jobs',
                        ],
                        [
                            'name' => 'Apple',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg',
                            'jobs' => '800+ Jobs',
                        ],
                        [
                            'name' => 'Amazon',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg',
                            'jobs' => '1,500+ Jobs',
                        ],
                        [
                            'name' => 'Meta',
                            'logo' =>
                                'https://upload.wikimedia.org/wikipedia/commons/7/7b/Meta_Platforms_Inc._logo.svg',
                            'jobs' => '700+ Jobs',
                        ],
                        [
                            'name' => 'Netflix',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_2015_logo.svg',
                            'jobs' => '400+ Jobs',
                        ],
                        [
                            'name' => 'Tesla',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/b/bd/Tesla_Motors.svg',
                            'jobs' => '600+ Jobs',
                        ],
                        [
                            'name' => 'Adobe',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/6e/Adobe_Corporate_logo.svg',
                            'jobs' => '500+ Jobs',
                        ],
                        [
                            'name' => 'IBM',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/51/IBM_logo.svg',
                            'jobs' => '1,000+ Jobs',
                        ],
                        [
                            'name' => 'Intel',
                            'logo' =>
                                'https://upload.wikimedia.org/wikipedia/commons/7/7d/Intel_logo_%282006-2020%29.svg',
                            'jobs' => '800+ Jobs',
                        ],
                        [
                            'name' => 'Oracle',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/50/Oracle_logo.svg',
                            'jobs' => '700+ Jobs',
                        ],
                        [
                            'name' => 'Cisco',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/0/08/Cisco_logo_blue_2016.svg',
                            'jobs' => '600+ Jobs',
                        ],
                        [
                            'name' => 'Salesforce',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/f/f9/Salesforce.com_logo.svg',
                            'jobs' => '500+ Jobs',
                        ],
                        [
                            'name' => 'Uber',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/58/Uber_logo_2018.svg',
                            'jobs' => '400+ Jobs',
                        ],
                        [
                            'name' => 'Airbnb',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/69/Airbnb_Logo_B%C3%A9lo.svg',
                            'jobs' => '300+ Jobs',
                        ],
                        [
                            'name' => 'Spotify',
                            'logo' =>
                                'https://upload.wikimedia.org/wikipedia/commons/1/19/Spotify_logo_without_text.svg',
                            'jobs' => '200+ Jobs',
                        ],
                        [
                            'name' => 'LinkedIn',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png',
                            'jobs' => '400+ Jobs',
                        ],
                        [
                            'name' => 'Twitter',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/6f/Logo_of_Twitter.svg',
                            'jobs' => '300+ Jobs',
                        ],
                        [
                            'name' => 'PayPal',
                            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg',
                            'jobs' => '500+ Jobs',
                        ],
                        [
                            'name' => 'Stripe',
                            'logo' =>
                                'https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg',
                            'jobs' => '400+ Jobs',
                        ],
                    ];
                @endphp
                @for ($i = 0; $i < count($companies); $i += 4)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                        <div class="row g-4">
                            @for ($j = $i; $j < min($i + 4, count($companies)); $j++)
                                <div class="col-md-3 col-6">
                                    <div class="card h-100 text-center p-4 company-card">
                                        <img src="{{ $companies[$j]['logo'] }}" alt="{{ $companies[$j]['name'] }}"
                                            class="company-logo mx-auto">
                                        <h5 class="mt-3">{{ $companies[$j]['name'] }}</h5>
                                        <p class="text-muted">{{ $companies[$j]['jobs'] }}</p>
                                        <a href="#" class="btn btn-outline-primary">View Jobs</a>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                @endfor
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#companiesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#companiesCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>


    <div class="bg-light py-5" id="testimonials">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">What Our Users Say</h2>
            <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    @php
                        $testimonials = [
                            [
                                'name' => 'Budi Santoso',
                                'role' => 'Web Developer',
                                'image' => 'https://randomuser.me/api/portraits/men/1.jpg',
                                'text' =>
                                    'Sangat membantu dalam mencari pekerjaan impian saya. Platform yang sangat user-friendly dan efektif.',
                            ],
                            [
                                'name' => 'Siti Rahayu',
                                'role' => 'UX Designer',
                                'image' => 'https://randomuser.me/api/portraits/women/1.jpg',
                                'text' =>
                                    'Proses lamaran kerja menjadi lebih mudah dan terorganisir. Terima kasih AYPJob!',
                            ],
                            [
                                'name' => 'Agus Setiawan',
                                'role' => 'Marketing Manager',
                                'image' => 'https://randomuser.me/api/portraits/men/2.jpg',
                                'text' =>
                                    'Banyak lowongan berkualitas dari perusahaan ternama. Sangat direkomendasikan!',
                            ],
                            [
                                'name' => 'Dewi Kusuma',
                                'role' => 'HR Specialist',
                                'image' => 'https://randomuser.me/api/portraits/women/2.jpg',
                                'text' =>
                                    'Platform yang sangat membantu dalam proses rekrutmen. Fitur-fiturnya lengkap dan mudah digunakan.',
                            ],
                            [
                                'name' => 'Rudi Hartono',
                                'role' => 'Data Scientist',
                                'image' => 'https://randomuser.me/api/portraits/men/3.jpg',
                                'text' => 'Mendapatkan pekerjaan impian dalam waktu singkat. Terima kasih AYPJob!',
                            ],
                            [
                                'name' => 'Ani Wijaya',
                                'role' => 'Content Writer',
                                'image' => 'https://randomuser.me/api/portraits/women/3.jpg',
                                'text' =>
                                    'Sangat membantu dalam mengembangkan karir saya. Banyak peluang kerja yang sesuai.',
                            ],
                            [
                                'name' => 'Joko Susilo',
                                'role' => 'Mobile Developer',
                                'image' => 'https://randomuser.me/api/portraits/men/4.jpg',
                                'text' =>
                                    'Platform yang sangat profesional dan terpercaya. Sangat membantu karir saya.',
                            ],
                            [
                                'name' => 'Rina Fitriani',
                                'role' => 'Product Manager',
                                'image' => 'https://randomuser.me/api/portraits/women/4.jpg',
                                'text' => 'Proses lamaran kerja yang efisien dan cepat. Sangat memuaskan!',
                            ],
                            [
                                'name' => 'Ahmad Fauzi',
                                'role' => 'DevOps Engineer',
                                'image' => 'https://randomuser.me/api/portraits/men/5.jpg',
                                'text' => 'Banyak lowongan berkualitas dari perusahaan teknologi terkemuka.',
                            ],
                            [
                                'name' => 'Maya Putri',
                                'role' => 'Graphic Designer',
                                'image' => 'https://randomuser.me/api/portraits/women/5.jpg',
                                'text' => 'Platform yang sangat membantu dalam mencari pekerjaan kreatif.',
                            ],
                            [
                                'name' => 'Hendra Pratama',
                                'role' => 'Network Engineer',
                                'image' => 'https://randomuser.me/api/portraits/men/6.jpg',
                                'text' => 'Proses rekrutmen yang transparan dan profesional.',
                            ],
                            [
                                'name' => 'Linda Sari',
                                'role' => 'Business Analyst',
                                'image' => 'https://randomuser.me/api/portraits/women/6.jpg',
                                'text' => 'Sangat membantu dalam menemukan pekerjaan yang sesuai dengan skill saya.',
                            ],
                            [
                                'name' => 'Yusuf Rahman',
                                'role' => 'QA Engineer',
                                'image' => 'https://randomuser.me/api/portraits/men/7.jpg',
                                'text' => 'Platform yang sangat membantu dalam mengembangkan karir di bidang IT.',
                            ],
                            [
                                'name' => 'Ratna Dewi',
                                'role' => 'Digital Marketer',
                                'image' => 'https://randomuser.me/api/portraits/women/7.jpg',
                                'text' => 'Banyak peluang kerja yang menarik dan sesuai dengan minat saya.',
                            ],
                            [
                                'name' => 'Dedi Kurniawan',
                                'role' => 'System Administrator',
                                'image' => 'https://randomuser.me/api/portraits/men/8.jpg',
                                'text' => 'Proses lamaran kerja yang mudah dan efisien.',
                            ],
                            [
                                'name' => 'Nina Astuti',
                                'role' => 'UI/UX Designer',
                                'image' => 'https://randomuser.me/api/portraits/women/8.jpg',
                                'text' => 'Platform yang sangat membantu dalam mencari pekerjaan di bidang desain.',
                            ],
                            [
                                'name' => 'Arif Hidayat',
                                'role' => 'Backend Developer',
                                'image' => 'https://randomuser.me/api/portraits/men/9.jpg',
                                'text' => 'Banyak lowongan berkualitas dari perusahaan teknologi.',
                            ],
                            [
                                'name' => 'Sinta Wulandari',
                                'role' => 'Frontend Developer',
                                'image' => 'https://randomuser.me/api/portraits/women/9.jpg',
                                'text' => 'Proses lamaran kerja yang cepat dan efisien.',
                            ],
                            [
                                'name' => 'Bayu Pratama',
                                'role' => 'Full Stack Developer',
                                'image' => 'https://randomuser.me/api/portraits/men/10.jpg',
                                'text' => 'Platform yang sangat membantu dalam mengembangkan karir di bidang IT.',
                            ],
                            [
                                'name' => 'Dina Fitri',
                                'role' => 'Project Manager',
                                'image' => 'https://randomuser.me/api/portraits/women/10.jpg',
                                'text' => 'Banyak peluang kerja yang menarik dan sesuai dengan skill saya.',
                            ],
                            [
                                'name' => 'Rizky Ramadhan',
                                'role' => 'Software Engineer',
                                'image' => 'https://randomuser.me/api/portraits/men/11.jpg',
                                'text' => 'Proses rekrutmen yang profesional dan transparan.',
                            ],
                            [
                                'name' => 'Putri Ayu',
                                'role' => 'Content Strategist',
                                'image' => 'https://randomuser.me/api/portraits/women/11.jpg',
                                'text' => 'Platform yang sangat membantu dalam mencari pekerjaan kreatif.',
                            ],
                            [
                                'name' => 'Fajar Nugroho',
                                'role' => 'IT Consultant',
                                'image' => 'https://randomuser.me/api/portraits/men/12.jpg',
                                'text' => 'Banyak lowongan berkualitas dari perusahaan ternama.',
                            ],
                            [
                                'name' => 'Rina Puspita',
                                'role' => 'Social Media Manager',
                                'image' => 'https://randomuser.me/api/portraits/women/12.jpg',
                                'text' => 'Proses lamaran kerja yang mudah dan efisien.',
                            ],
                        ];
                    @endphp
                    @for ($i = 0; $i < count($testimonials); $i += 4)
                        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                            <div class="row g-4">
                                @for ($j = $i; $j < min($i + 4, count($testimonials)); $j++)
                                    <div class="col-md-3 col-6">
                                        <div class="testimonial-card h-100 text-center p-4">
                                            <img src="{{ $testimonials[$j]['image'] }}"
                                                alt="{{ $testimonials[$j]['name'] }}"
                                                class="testimonial-img mx-auto mb-3">
                                            <h5 class="mt-3">{{ $testimonials[$j]['name'] }}</h5>
                                            <p class="text-muted mb-2">{{ $testimonials[$j]['role'] }}</p>
                                            <p class="mb-0">{{ $testimonials[$j]['text'] }}</p>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endfor
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-4">Ready to Find Your Dream Job?</h2>
                <p class="lead mb-5">Join thousands of successful job seekers who found their perfect match through our
                    platform.</p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg"><i
                            class="fas fa-user-plus me-2"></i>Create
                        Account</a>
                </div>
            </div>
        </div>
    </div>
@endsection
