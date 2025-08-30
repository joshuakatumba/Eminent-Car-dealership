@extends('admin.layouts.app')

@section('title', 'Edit Blog Post')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Edit Blog Post: {{ $content->title }}</h4>
                    <a href="{{ route('admin.content.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Content
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.content.update', $content) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="mb-3">Post Content</h5>
                                
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title', $content->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Excerpt</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                              id="excerpt" name="excerpt" rows="3" 
                                              placeholder="Brief summary of the post...">{{ old('excerpt', $content->excerpt) }}</textarea>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" name="content" rows="15" required>{{ old('content', $content->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <h5 class="mb-3">Post Settings</h5>
                                
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="draft" {{ old('status', $content->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status', $content->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="featured_image" class="form-label">Featured Image</label>
                                    @if($content->featured_image_url)
                                        <div class="mb-2">
                                            <img src="{{ $content->featured_image_url }}" alt="Current featured image" class="img-fluid rounded" style="max-height: 150px;">
                                            <div class="form-text">Current image</div>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                           id="featured_image" name="featured_image" accept="image/*">
                                    <div class="form-text">Upload a new image (JPEG, PNG, JPG, GIF, WEBP). Max size: 2MB. Leave empty to keep current image.</div>
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="image-preview" class="mt-2" style="display: none;">
                                        <img id="preview-img" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                        <div class="form-text">New image preview</div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                           id="meta_title" name="meta_title" value="{{ old('meta_title', $content->meta_title) }}"
                                           maxlength="60" placeholder="SEO title (max 60 characters)">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                              id="meta_description" name="meta_description" rows="3" 
                                              maxlength="160" placeholder="SEO description (max 160 characters)">{{ old('meta_description', $content->meta_description) }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                                           id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $content->meta_keywords) }}"
                                           placeholder="keyword1, keyword2, keyword3">
                                    @error('meta_keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Post Information</label>
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <p class="mb-1"><strong>Author:</strong> {{ $content->author->name ?? 'N/A' }}</p>
                                            <p class="mb-1"><strong>Created:</strong> {{ $content->created_at->format('M d, Y H:i') }}</p>
                                            <p class="mb-1"><strong>Last Updated:</strong> {{ $content->updated_at->format('M d, Y H:i') }}</p>
                                            @if($content->published_at)
                                                <p class="mb-0"><strong>Published:</strong> {{ $content->published_at->format('M d, Y H:i') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate meta title from post title
    const titleInput = document.getElementById('title');
    const metaTitleInput = document.getElementById('meta_title');
    
    titleInput.addEventListener('input', function() {
        if (!metaTitleInput.value) {
            metaTitleInput.value = this.value;
        }
    });
    
    // Auto-generate excerpt from content
    const contentInput = document.getElementById('content');
    const excerptInput = document.getElementById('excerpt');
    
    contentInput.addEventListener('input', function() {
        if (!excerptInput.value && this.value.length > 0) {
            const excerpt = this.value.substring(0, 150);
            excerptInput.value = excerpt + (this.value.length > 150 ? '...' : '');
        }
    });
    
    // Image preview functionality
    const imageInput = document.getElementById('featured_image');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection
