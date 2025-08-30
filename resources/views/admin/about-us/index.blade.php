@extends('admin.layouts.app')

@section('title', 'About Us Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">About Us Content Management</h4>
                    <p class="card-text">Manage the content displayed on the About Us page.</p>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.about-us.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Our Story Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">Our Story Section</h5>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="about_title" class="form-label">Section Title</label>
                                    <input type="text" class="form-control @error('about_title') is-invalid @enderror" 
                                           id="about_title" name="about_title" 
                                           value="{{ old('about_title', $settings['about_title'] ?? 'Our Story') }}" required>
                                    @error('about_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="about_paragraph_1" class="form-label">Paragraph 1</label>
                                    <textarea class="form-control @error('about_paragraph_1') is-invalid @enderror" 
                                              id="about_paragraph_1" name="about_paragraph_1" rows="4" required>{{ old('about_paragraph_1', $settings['about_paragraph_1'] ?? '') }}</textarea>
                                    @error('about_paragraph_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="about_paragraph_2" class="form-label">Paragraph 2</label>
                                    <textarea class="form-control @error('about_paragraph_2') is-invalid @enderror" 
                                              id="about_paragraph_2" name="about_paragraph_2" rows="4" required>{{ old('about_paragraph_2', $settings['about_paragraph_2'] ?? '') }}</textarea>
                                    @error('about_paragraph_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="about_paragraph_3" class="form-label">Paragraph 3</label>
                                    <textarea class="form-control @error('about_paragraph_3') is-invalid @enderror" 
                                              id="about_paragraph_3" name="about_paragraph_3" rows="4" required>{{ old('about_paragraph_3', $settings['about_paragraph_3'] ?? '') }}</textarea>
                                    @error('about_paragraph_3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="about_image" class="form-label">About Image</label>
                                    <input type="file" class="form-control @error('about_image') is-invalid @enderror" 
                                           id="about_image" name="about_image" 
                                           accept="image/*">
                                    <div class="form-text">Upload a new image (JPG, PNG, GIF, WEBP). Recommended size: 800x600px or larger.</div>
                                    @error('about_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Current Image Preview</label>
                                    <div class="border rounded p-3 text-center">
                                        <img src="{{ asset($settings['about_image'] ?? 'assets/images/landcruiser-series/01.jpg') }}" 
                                             class="img-fluid" style="max-height: 200px;" alt="About Us Image" id="imagePreview">
                                    </div>
                                    @if($settings['about_image'] ?? false)
                                        <div class="mt-2">
                                            <small class="text-muted">Current image: {{ $settings['about_image'] }}</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Why Choose Us Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">Why Choose Us Section</h5>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="why_choose_title" class="form-label">Section Title</label>
                                <input type="text" class="form-control @error('why_choose_title') is-invalid @enderror" 
                                       id="why_choose_title" name="why_choose_title" 
                                       value="{{ old('why_choose_title', $settings['why_choose_title'] ?? 'Why Choose Us') }}" required>
                                @error('why_choose_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Feature 1 -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary">Feature 1 - Quality Assurance</h6>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="feature_1_icon" class="form-label">Icon Path</label>
                                    <input type="text" class="form-control @error('feature_1_icon') is-invalid @enderror" 
                                           id="feature_1_icon" name="feature_1_icon" 
                                           value="{{ old('feature_1_icon', $settings['feature_1_icon'] ?? 'assets/images/icons/delivery.webp') }}" required>
                                    @error('feature_1_icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="feature_1_title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('feature_1_title') is-invalid @enderror" 
                                           id="feature_1_title" name="feature_1_title" 
                                           value="{{ old('feature_1_title', $settings['feature_1_title'] ?? 'Quality Assurance') }}" required>
                                    @error('feature_1_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="feature_1_description" class="form-label">Description</label>
                                    <textarea class="form-control @error('feature_1_description') is-invalid @enderror" 
                                              id="feature_1_description" name="feature_1_description" rows="3" required>{{ old('feature_1_description', $settings['feature_1_description'] ?? '') }}</textarea>
                                    @error('feature_1_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Feature 2 -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary">Feature 2 - Best Price Guarantee</h6>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="feature_2_icon" class="form-label">Icon Path</label>
                                    <input type="text" class="form-control @error('feature_2_icon') is-invalid @enderror" 
                                           id="feature_2_icon" name="feature_2_icon" 
                                           value="{{ old('feature_2_icon', $settings['feature_2_icon'] ?? 'assets/images/icons/money-bag.webp') }}" required>
                                    @error('feature_2_icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="feature_2_title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('feature_2_title') is-invalid @enderror" 
                                           id="feature_2_title" name="feature_2_title" 
                                           value="{{ old('feature_2_title', $settings['feature_2_title'] ?? 'Best Price Guarantee') }}" required>
                                    @error('feature_2_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="feature_2_description" class="form-label">Description</label>
                                    <textarea class="form-control @error('feature_2_description') is-invalid @enderror" 
                                              id="feature_2_description" name="feature_2_description" rows="3" required>{{ old('feature_2_description', $settings['feature_2_description'] ?? '') }}</textarea>
                                    @error('feature_2_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Feature 3 -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary">Feature 3 - Expert Support</h6>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="feature_3_icon" class="form-label">Icon Path</label>
                                    <input type="text" class="form-control @error('feature_3_icon') is-invalid @enderror" 
                                           id="feature_3_icon" name="feature_3_icon" 
                                           value="{{ old('feature_3_icon', $settings['feature_3_icon'] ?? 'assets/images/icons/support.webp') }}" required>
                                    @error('feature_3_icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="feature_3_title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('feature_3_title') is-invalid @enderror" 
                                           id="feature_3_title" name="feature_3_title" 
                                           value="{{ old('feature_3_title', $settings['feature_3_title'] ?? 'Expert Support') }}" required>
                                    @error('feature_3_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="feature_3_description" class="form-label">Description</label>
                                    <textarea class="form-control @error('feature_3_description') is-invalid @enderror" 
                                              id="feature_3_description" name="feature_3_description" rows="3" required>{{ old('feature_3_description', $settings['feature_3_description'] ?? '') }}</textarea>
                                    @error('feature_3_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update About Us Content</button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Image preview functionality
    document.getElementById('about_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        
        if (file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please select a valid image file.');
                this.value = '';
                return;
            }
            
            // Validate file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Image size should be less than 5MB.');
                this.value = '';
                return;
            }
            
            // Create preview
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush

@endsection
