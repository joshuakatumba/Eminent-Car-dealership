@extends('admin.layouts.app')

@section('title', 'Content Management - Admin Panel')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Content Management</h4>
                <div class="page-title-right">
                    <a href="{{ route('admin.content.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Post
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Published Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($blogPosts ?? [] as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>
                                        @if($post->featured_image_url)
                                            <img src="{{ $post->featured_image_url }}" alt="Featured Image" 
                                                 class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->author->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $post->status === 'published' ? 'success' : ($post->status === 'draft' ? 'warning' : 'info') }}">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : 'Not Published' }}</td>
                                    <td>
                                        <a href="{{ route('admin.content.show', $post) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.content.edit', $post) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.content.destroy', $post) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
