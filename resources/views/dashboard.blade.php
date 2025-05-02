@extends('layouts.app2')

@section('content')
    <div class="container py-4">
        <div class="row">
            <!-- Left Section - Profile Info -->
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            @if ($user->profile_picture)
                                <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_picture) }}"
                                    class="rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;"
                                    alt="Profile Picture">
                            @else
                                <img src="{{ asset('storage/avatar_default.png') }}" class="rounded-circle mb-2"
                                    style="width: 100px; height: 100px; object-fit: cover;" alt="Profile Picture">
                            @endif
                            <h5 class="mb-1">{{ $user->name }}</h5>
                            <p class="text-muted small mb-2">{{ $jobSeeker->title ?? 'No title set' }}</p>
                            <div class="border-top pt-2">
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>Profile Views</span>
                                    <span>100</span>
                                </div>
                                <div class="d-flex justify-content-between small text-muted">
                                    <span>Post Views</span>
                                    <span>500</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('profile') }}" class="btn btn-outline-primary btn-sm">View Profile</a>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="card-title">Recent Activity</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2">
                                <i class="fas fa-briefcase text-primary me-2"></i>
                                Applied for Senior Developer position
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-user-plus text-success me-2"></i>
                                Connected with Sarah Smith
                            </li>
                            <li>
                                <i class="fas fa-thumbs-up text-info me-2"></i>
                                Liked a post about Web Development
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Middle Section - Feed -->
            <div class="col-md-6">
                <!-- Create Post Section -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            @if ($user->profile_picture)
                                <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_picture) }}"
                                    class="rounded-circle mb-2" style="width: 40px; height: 40px; object-fit: cover;"
                                    alt="Profile Picture">
                            @else
                                <img src="{{ asset('storage/avatar_default.png') }}" class="rounded-circle me-2"
                                    style="width: 40px; height: 40px; object-fit: cover;" alt="Profile Picture">
                            @endif
                            <input type="text" class="form-control ms-2" placeholder="Start a post"
                                data-bs-toggle="modal" data-bs-target="#createPostModal">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-image text-primary"></i> Photo
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-video text-success"></i> Video
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-calendar text-warning"></i> Event
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-newspaper text-danger"></i> Article
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Feed Posts -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <img src="https://picsum.photos/200/200?random=3" class="rounded-circle me-2"
                                style="width: 40px; height: 40px; object-fit: cover;" alt="Profile Picture">
                            <div>
                                <h6 class="mb-0">Sarah Smith</h6>
                                <small class="text-muted">Software Developer at Tech Corp</small>
                            </div>
                        </div>
                        <p class="card-text">Just completed an amazing project using Laravel and Vue.js! The team did an
                            incredible job working together to deliver this solution.</p>
                        <img src="https://picsum.photos/800/400?random=4" class="img-fluid rounded mb-3" alt="Post Image">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="far fa-thumbs-up"></i> Like
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="far fa-comment"></i> Comment
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="far fa-share-square"></i> Share
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <img src="https://picsum.photos/200/200?random=5" class="rounded-circle me-2"
                                style="width: 40px; height: 40px; object-fit: cover;" alt="Profile Picture">
                            <div>
                                <h6 class="mb-0">Mike Johnson</h6>
                                <small class="text-muted">Senior Developer at Web Solutions</small>
                            </div>
                        </div>
                        <p class="card-text">Looking for a talented frontend developer to join our team! If you're
                            passionate about React and have experience with TypeScript, we'd love to hear from you.</p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="far fa-thumbs-up"></i> Like
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="far fa-comment"></i> Comment
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="far fa-share-square"></i> Share
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <img src="https://picsum.photos/200/200?random=11" class="rounded-circle me-2"
                                style="width: 40px; height: 40px; object-fit: cover;" alt="Profile Picture">
                            <div>
                                <h6 class="mb-0">Sophia Chen</h6>
                                <small class="text-muted">Marketing Director at Digital Agency</small>
                            </div>
                        </div>
                        <p class="card-text">Just wrapped up our biggest campaign of the year! Huge thanks to the entire
                            team for their hard work. The results exceeded all our expectations!</p>
                        <img src="https://picsum.photos/800/400?random=12" class="img-fluid rounded mb-3"
                            alt="Post Image">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="far fa-thumbs-up"></i> Like
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="far fa-comment"></i> Comment
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="far fa-share-square"></i> Share
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <img src="https://picsum.photos/200/200?random=13" class="rounded-circle me-2"
                                style="width: 40px; height: 40px; object-fit: cover;" alt="Profile Picture">
                            <div>
                                <h6 class="mb-0">Jajang</h6>
                                <small class="text-muted">CTO at PodHub</small>
                            </div>
                        </div>
                        <p class="card-text">We're hiring! Looking for a full-stack developer with experience in Node.js
                            and React. Remote position with competitive salary and equity. DM me if interested!</p>
                        <img src="https://picsum.photos/800/400?random=14" class="img-fluid rounded mb-3"
                            alt="Post Image">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="far fa-thumbs-up"></i> Like
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="far fa-comment"></i> Comment
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="far fa-share-square"></i> Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Right Section - Suggestions -->
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="card-title">People you may know</h6>
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://picsum.photos/200/200?random=6" class="rounded-circle me-2"
                                style="width: 40px; height: 40px; object-fit: cover;" alt="Profile Picture">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Syukur Sidiq</h6>
                                <small class="text-muted">Frontend Developer</small>
                            </div>
                            <button class="btn btn-outline-primary btn-sm">Connect</button>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://picsum.photos/200/200?random=7" class="rounded-circle me-2"
                                style="width: 40px; height: 40px; object-fit: cover;" alt="Profile Picture">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Abdul Rahman</h6>
                                <small class="text-muted">UI/UX Designer</small>
                            </div>
                            <button class="btn btn-outline-primary btn-sm">Connect</button>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="https://picsum.photos/200/200?random=8" class="rounded-circle me-2"
                                style="width: 40px; height: 40px; object-fit: cover;" alt="Profile Picture">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Asep Supriyadi</h6>
                                <small class="text-muted">Backend Developer</small>
                            </div>
                            <button class="btn btn-outline-primary btn-sm">Connect</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Trending Topics</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    <span class="badge bg-light text-dark">#WebDevelopment</span>
                                    <small class="text-muted d-block">2,500 posts</small>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    <span class="badge bg-light text-dark">#Laravel</span>
                                    <small class="text-muted d-block">1,800 posts</small>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-decoration-none">
                                    <span class="badge bg-light text-dark">#RemoteWork</span>
                                    <small class="text-muted d-block">3,200 posts</small>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Post Modal -->
    <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPostModalLabel">Create a Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex mb-3">
                        @if ($user->profile_picture)
                            <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_picture) }}"
                                class="rounded-circle mb-2" style="width: 40px; height: 40px; object-fit: cover;""
                                alt="Profile Picture">
                        @else
                            <img src="{{ asset('storage/avatar_default.png') }}" class="rounded-circle me-2"
                                style="width: 40px; height: 40px; object-fit: cover;" alt="Profile Picture">
                        @endif
                        <div class="ms-2">
                            <h6 class="mb-0">Agung Yuda</h6>
                            <small class="text-muted">Software Engineer</small>
                        </div>
                    </div>
                    <form id="postForm">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="postTitle"
                                placeholder="Add a title to your post">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="postContent" rows="8" placeholder="What do you want to talk about?"></textarea>
                        </div>

                        <!-- Image Preview Container -->
                        <div id="imagePreviewContainer" class="mb-3 d-none">
                            <div class="position-relative">
                                <img id="imagePreview" class="img-fluid rounded"
                                    style="max-height: 300px; object-fit: cover;">
                                <button type="button" id="removeImage"
                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Media Options -->
                        <div class="mb-3">
                            <div class="d-flex flex-wrap gap-2">
                                <div class="media-option" data-type="image">
                                    <input type="file" class="d-none" id="postImage" accept="image/*">
                                    <label for="postImage" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-image text-primary"></i> Photo
                                    </label>
                                </div>
                                <div class="media-option" data-type="video">
                                    <input type="file" class="d-none" id="postVideo" accept="video/*">
                                    <label for="postVideo" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-video text-success"></i> Video
                                    </label>
                                </div>
                                <div class="media-option" data-type="document">
                                    <input type="file" class="d-none" id="postDocument" accept=".pdf,.doc,.docx">
                                    <label for="postDocument" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-file-alt text-info"></i> Document
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-secondary {
            color: #666;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
        }

        .badge {
            font-weight: normal;
            padding: 5px 10px;
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            border-bottom: 1px solid #e9ecef;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
        }

        #postContent {
            resize: none;
        }

        .media-option {
            position: relative;
        }

        .media-option input[type="file"] {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        #imagePreviewContainer {
            position: relative;
        }

        #removeImage {
            z-index: 1;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const postImage = document.getElementById('postImage');
            const imagePreview = document.getElementById('imagePreview');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const removeImage = document.getElementById('removeImage');

            postImage.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreviewContainer.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                }
            });

            removeImage.addEventListener('click', function() {
                imagePreview.src = '';
                imagePreviewContainer.classList.add('d-none');
                postImage.value = '';
            });
        });
    </script>
@endsection
