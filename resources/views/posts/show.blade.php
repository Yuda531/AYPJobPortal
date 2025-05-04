@extends('layouts.app2')

@section('content')
    <div class="container container-bg py-4">
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

        <div class="row">
            <!-- Main Content -->
            <div class="col-md-8 mx-auto">
                <!-- Post Card -->
                <div class="card mb-4">
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
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Comments</h6>

                        <!-- Comment Form -->
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="d-flex">
                                @if (auth()->user()->profile_picture)
                                    <img src="data:image/jpeg;base64,{{ base64_encode(auth()->user()->profile_picture) }}"
                                        class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: fill;"
                                        alt="Profile Picture">
                                @else
                                    <img src="{{ asset('storage/avatar_default.png') }}" class="rounded-circle me-2"
                                        style="width: 40px; height: 40px; object-fit: fill;" alt="Profile Picture">
                                @endif
                                <div class="flex-grow-1">
                                    <textarea class="form-control" name="content" rows="2" placeholder="Write a comment..." required></textarea>
                                </div>
                            </div>
                            <div class="text-end mt-2">
                                <button type="submit" class="btn btn-primary btn-sm">Comment</button>
                            </div>
                        </form>

                        <!-- Comments List -->
                        @foreach ($post->comments as $comment)
                            <div class="d-flex mb-3">
                                @if ($comment->user->profile_picture)
                                    <img src="data:image/jpeg;base64,{{ base64_encode($comment->user->profile_picture) }}"
                                        class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: fill;"
                                        alt="Profile Picture">
                                @else
                                    <img src="{{ asset('storage/avatar_default.png') }}" class="rounded-circle me-2"
                                        style="width: 40px; height: 40px; object-fit: fill;" alt="Profile Picture">
                                @endif
                                <div class="flex-grow-1">
                                    <div class="bg-light p-3 rounded">
                                        <h6 class="mb-1">{{ $comment->user->name }}</h6>
                                        <p class="mb-0">{{ $comment->content }}</p>
                                    </div>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                                @if ($comment->user_id === auth()->id())
                                    <div class="dropdown">
                                        <button class="btn btn-link text-muted" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('comments.destroy', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash-alt me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Post Modal -->
    @if ($post->user_id === auth()->id())
        <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1"
            aria-labelledby="editPostModalLabel{{ $post->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPostModalLabel{{ $post->id }}">Edit Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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

        <!-- Delete Post Modal -->
        <div class="modal fade" id="deletePostModal{{ $post->id }}" tabindex="-1"
            aria-labelledby="deletePostModalLabel{{ $post->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePostModalLabel{{ $post->id }}">Delete Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

    <style>
        .container-bg {
            min-height: 70vh;
        }
    </style>
@endsection
