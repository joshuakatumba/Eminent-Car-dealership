@extends('admin.layouts.app')

@section('title', 'Blog Post Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Blog Post: {{ $content->title }}</h4>
                    <div>
                        <a href="{{ route('admin.content.edit', $content) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.content.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Content
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="mb-3">Post Content</h5>
                            
                            @if($content->featured_image_url)
                            <div class="mb-4">
                                <img src="{{ $content->featured_image_url }}" alt="Featured Image" 
                                     class="img-fluid rounded" style="max-height: 300px;">
                            </div>
                            @endif
                            
                            <div class="mb-4">
                                <h2>{{ $content->title }}</h2>
                                <div class="text-muted mb-3">
                                    <span class="badge bg-{{ $content->status === 'published' ? 'success' : 'warning' }}">
                                        {{ ucfirst($content->status) }}
                                    </span>
                                    <span class="ms-2">By {{ $content->author->name ?? 'Unknown' }}</span>
                                    <span class="ms-2">• {{ $content->created_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                            
                            @if($content->excerpt)
                            <div class="mb-4">
                                <h6>Excerpt:</h6>
                                <p class="text-muted">{{ $content->excerpt }}</p>
                            </div>
                            @endif
                            
                            <div class="mb-4">
                                <h6>Content:</h6>
                                <div class="border rounded p-3 bg-light">
                                    {!! nl2br(e($content->content)) !!}
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <h5 class="mb-3">Post Information</h5>
                            
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6>Basic Information</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                <span class="badge bg-{{ $content->status === 'published' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($content->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Author:</strong></td>
                                            <td>{{ $content->author->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Created:</strong></td>
                                            <td>{{ $content->created_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Last Updated:</strong></td>
                                            <td>{{ $content->updated_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                        @if($content->published_at)
                                        <tr>
                                            <td><strong>Published:</strong></td>
                                            <td>{{ $content->published_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td><strong>Slug:</strong></td>
                                            <td><code>{{ $content->slug }}</code></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            @if($content->meta_title || $content->meta_description || $content->meta_keywords)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6>SEO Information</h6>
                                    @if($content->meta_title)
                                    <p class="mb-1"><strong>Meta Title:</strong></p>
                                    <p class="text-muted small mb-2">{{ $content->meta_title }}</p>
                                    @endif
                                    
                                    @if($content->meta_description)
                                    <p class="mb-1"><strong>Meta Description:</strong></p>
                                    <p class="text-muted small mb-2">{{ $content->meta_description }}</p>
                                    @endif
                                    
                                    @if($content->meta_keywords)
                                    <p class="mb-1"><strong>Meta Keywords:</strong></p>
                                    <p class="text-muted small">{{ $content->meta_keywords }}</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                            
                            <div class="card">
                                <div class="card-body">
                                    <h6>Actions</h6>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.content.edit', $content) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit Post
                                        </a>
                                        <form action="{{ route('admin.content.destroy', $content) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                                <i class="fas fa-trash"></i> Delete Post
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
