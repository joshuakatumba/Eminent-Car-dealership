@extends('admin.layouts.app')

@section('title', 'Blog Posts')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-blog me-2"></i>Blog Posts
                        <span class="badge bg-primary ms-2">{{ $blogPosts->total() }}</span>
                    </h4>
                    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create New Post
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Statistics Row -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="stats-card success">
                                <h3>{{ $blogPosts->where('status', 'published')->count() }}</h3>
                                <p>Published Posts</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card warning">
                                <h3>{{ $blogPosts->where('status', 'draft')->count() }}</h3>
                                <p>Draft Posts</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card info">
                                <h3>{{ $blogPosts->where('featured_image', '!=', null)->count() }}</h3>
                                <p>Posts with Images</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card secondary">
                                <h3>{{ $blogPosts->count() }}</h3>
                                <p>Total Posts</p>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Published Date</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($blogPosts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>
                                            <strong>{{ $post->title }}</strong>
                                            @if($post->featured_image)
                                                <i class="fas fa-image text-muted ms-2" title="Has featured image"></i>
                                            @endif
                                        </td>
                                        <td>{{ $post->author->name ?? 'Unknown' }}</td>
                                        <td>
                                            @if($post->status === 'published')
                                                <span class="badge bg-success">Published</span>
                                            @else
                                                <span class="badge bg-warning">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($post->published_at)
                                                {{ $post->published_at->format('M d, Y') }}
                                            @else
                                                <span class="text-muted">Not published</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('blog.show', $post->slug) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   target="_blank"
                                                   title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.blog.edit', $post) }}" 
                                                   class="btn btn-sm btn-outline-secondary"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.blog.toggle-status', $post) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-{{ $post->status === 'published' ? 'warning' : 'success' }}"
                                                            title="{{ $post->status === 'published' ? 'Move to Draft' : 'Publish' }}">
                                                        <i class="fas fa-{{ $post->status === 'published' ? 'eye-slash' : 'check' }}"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.blog.destroy', $post) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this blog post?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger"
                                                            title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No blog posts found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($blogPosts->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $blogPosts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
