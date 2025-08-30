@extends('admin.layouts.app')

@section('title', 'Edit Blog Post')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Blog Post: {{ $blogPost->title }}</h4>
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.blog.update', $blogPost) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title *</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title', $blogPost->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Excerpt *</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                              id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt', $blogPost->excerpt) }}</textarea>
                                    <div class="form-text">A brief summary of the blog post (max 500 characters)</div>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Content *</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" name="content" rows="15" required>{{ old('content', $blogPost->content) }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="author_id" class="form-label">Author *</label>
                                    <select class="form-select @error('author_id') is-invalid @enderror" 
                                            id="author_id" name="author_id" required>
                                        <option value="">Select Author</option>
                                        @foreach($authors as $author)
                                            <option value="{{ $author->id }}" 
                                                {{ old('author_id', $blogPost->author_id) == $author->id ? 'selected' : '' }}>
                                                {{ $author->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('author_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status *</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="draft" {{ old('status', $blogPost->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status', $blogPost->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="featured_image" class="form-label">Featured Image</label>
                                    @if($blogPost->featured_image)
                                        <div class="mb-2">
                                            <img src="{{ $blogPost->featured_image_url }}" 
                                                 alt="Current featured image" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 200px;">
                                            <div class="form-text">Current image</div>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                           id="featured_image" name="featured_image" accept="image/*">
                                    <div class="form-text">Upload a new image to replace the current one (JPEG, PNG, JPG, GIF, WebP, max 2MB)</div>
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tags" class="form-label">Tags</label>
                                    <input type="text" class="form-control @error('tags') is-invalid @enderror" 
                                           id="tags" name="tags" 
                                           value="{{ old('tags', $blogPost->tags) }}" 
                                           placeholder="tag1, tag2, tag3">
                                    <div class="form-text">Separate tags with commas</div>
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                           id="meta_title" name="meta_title" 
                                           value="{{ old('meta_title', $blogPost->meta_title) }}">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                              id="meta_description" name="meta_description" 
                                              rows="3">{{ old('meta_description', $blogPost->meta_description) }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                                           id="meta_keywords" name="meta_keywords" 
                                           value="{{ old('meta_keywords', $blogPost->meta_keywords) }}">
                                    @error('meta_keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title">Post Information</h6>
                                            <p class="mb-1"><strong>Slug:</strong> {{ $blogPost->slug }}</p>
                                            <p class="mb-1"><strong>Created:</strong> {{ $blogPost->created_at->format('M d, Y H:i') }}</p>
                                            @if($blogPost->published_at)
                                                <p class="mb-1"><strong>Published:</strong> {{ $blogPost->published_at->format('M d, Y H:i') }}</p>
                                            @endif
                                            <p class="mb-0"><strong>Last Updated:</strong> {{ $blogPost->updated_at->format('M d, Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Blog Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            }
        })
        .catch(error => {
            console.error(error);
        });

    // Auto-generate meta title from title if empty
    document.getElementById('title').addEventListener('input', function() {
        const metaTitle = document.getElementById('meta_title');
        if (!metaTitle.value) {
            metaTitle.value = this.value + ' - Eminent Car Dealership';
        }
    });

    // Auto-generate meta description from excerpt if empty
    document.getElementById('excerpt').addEventListener('input', function() {
        const metaDescription = document.getElementById('meta_description');
        if (!metaDescription.value) {
            metaDescription.value = this.value;
        }
    });
</script>
@endpush
@endsection
