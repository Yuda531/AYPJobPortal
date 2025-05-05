@extends('layouts.app2')

@section('content')
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Left Section - Profile Info -->
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            @if ($user->profile_picture)
                                <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_picture) }}"
                                    class="rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: fill;"
                                    alt="Profile Picture">
                            @else
                                <img src="{{ asset('storage/avatar_default.png') }}" class="rounded-circle mb-2"
                                    style="width: 100px; height: 100px; object-fit: fill;" alt="Profile Picture">
                            @endif
                            <h5 class="mb-1">{{ $user->name }}</h5>
                            <p class="text-muted small mb-2">
                                @if ($user->role === 'job_seeker')
                                    {{ $jobSeeker->title ?? 'No title set' }}
                                @else
                                    <strong>{{ $employer->title ?? 'No title set' }}</strong> at
                                    <strong>{{ $employer->company_name ?? 'No company name set' }}</strong>
                                @endif
                            </p>
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
                            <a href="{{ route('profile.index') }}" class="btn btn-outline-primary btn-sm">View Profile</a>
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
                                    class="rounded-circle mb-2" style="width: 40px; height: 40px; object-fit: fill;"
                                    alt="Profile Picture">
                            @else
                                <img src="{{ asset('storage/avatar_default.png') }}" class="rounded-circle me-2"
                                    style="width: 40px; height: 40px; object-fit: fill;" alt="Profile Picture">
                            @endif
                            <input type="text" class="form-control ms-2" placeholder="Start a post"
                                data-bs-toggle="modal" data-bs-target="#createPostModal">
                        </div>
                        <div class="d-flex justify-content-between mx-5">
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-image text-primary"></i> Photo
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-video text-success"></i> Video
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-newspaper text-danger"></i> Article
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Feed Posts -->
                @foreach ($posts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                @if ($post->user->profile_picture)
                                    <img src="data:image/jpeg;base64,{{ base64_encode($post->user->profile_picture) }}"
                                        class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: fill;"
                                        alt="Profile Picture">
                                @else
                                    <img src="{{ asset('storage/avatar_default.png') }}" class="rounded-circle me-2"
                                        style="width: 40px; height: 40px; object-fit: fill;" alt="Profile Picture">
                                @endif
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $post->user->name }}</h6>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                                @if ($post->user_id === auth()->id())
                                    <div class="dropdown">
                                        <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editPostModal{{ $post->id }}">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#deletePostModal{{ $post->id }}">
                                                    <i class="fas fa-trash-alt me-2"></i>Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            @if ($post->image)
                                <img src="data:image/jpeg;base64,{{ base64_encode($post->image) }}"
                                    class="img-fluid rounded mb-3" alt="Post Image">
                            @endif
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="far fa-thumbs-up"></i> Like
                                </button>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="far fa-comment"></i> Comment
                                </a>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="far fa-share-square"></i> Share
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right Section - Suggestions -->
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="card-title">People you may know</h6>
                        @foreach ($suggestedUsers as $suggestedUser)
                            <div class="d-flex align-items-center mb-3">
                                @if ($suggestedUser->profile_picture)
                                    <img src="data:image/jpeg;base64,{{ base64_encode($suggestedUser->profile_picture) }}"
                                        class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: fill;"
                                        alt="Profile Picture">
                                @else
                                    <img src="{{ asset('storage/avatar_default.png') }}" class="rounded-circle me-2"
                                        style="width: 40px; height: 40px; object-fit: fill;" alt="Profile Picture">
                                @endif
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $suggestedUser->name }}</h6>
                                    <small class="text-muted">
                                        @if ($suggestedUser->role === 'job_seeker')
                                            {{ $suggestedUser->jobSeeker->title ?? 'No title set' }}
                                        @else
                                            {{ $suggestedUser->employer->company_name ?? 'No company set' }}
                                        @endif
                                    </small>
                                </div>
                                <button class="btn btn-outline-primary btn-sm">Connect</button>
                            </div>
                        @endforeach
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
                                class="rounded-circle mb-2" style="width: 40px; height: 40px; object-fit: fill;""
                                alt="Profile Picture">
                        @else
                            <img src="{{ asset('storage/avatar_default.png') }}" class="rounded-circle me-2"
                                style="width: 40px; height: 40px; object-fit: fill;" alt="Profile Picture">
                        @endif
                        <div class="ms-2">
                            <h6 class="mb-0">{{ $user->name }}</h6>
                            <small class="text-muted">
                                @if ($user->role === 'job_seeker')
                                    {{ $jobSeeker->title ?? 'No title set' }}
                                @else
                                    <strong>{{ $employer->title ?? 'No title set' }}</strong> at
                                    <strong>{{ $employer->company_name ?? 'No company name set' }}</strong>
                                @endif
                            </small>
                        </div>
                    </div>
                    <form id="postForm" action="{{ route('posts.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" name="title"
                                placeholder="Add a title to your post">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="content" name="content" rows="8"
                                placeholder="What do you want to talk about?"></textarea>
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
                                    <input type="file" class="d-none" id="postImage" name="image"
                                        accept="image/*">
                                    <label for="postImage" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-image text-primary"></i> Photo
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

    <!-- Edit Post Modal -->
    @foreach ($posts as $post)
        @if ($post->user_id === auth()->id())
            <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1"
                aria-labelledby="editPostModalLabel{{ $post->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPostModalLabel{{ $post->id }}">Edit Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('posts.update', $post->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $post->title }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea class="form-control" id="content" name="content" rows="3" required>{{ $post->content }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image (Optional)</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        accept="image/*">
                                    @if ($post->image)
                                        <div class="mt-2">
                                            <img src="data:image/jpeg;base64,{{ base64_encode($post->image) }}"
                                                class="img-thumbnail" style="max-width: 200px;" alt="Current Image">
                                            <p class="text-muted mt-1">Current image</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <!-- Delete Post Modal -->
    @foreach ($posts as $post)
        @if ($post->user_id === auth()->id())
            <div class="modal fade" id="deletePostModal{{ $post->id }}" tabindex="-1"
                aria-labelledby="deletePostModalLabel{{ $post->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deletePostModalLabel{{ $post->id }}">Delete Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this post? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

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
