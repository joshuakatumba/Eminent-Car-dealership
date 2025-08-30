@extends('admin.layouts.app')

@section('title', 'Add New Vehicle')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Add New Vehicle</h4>
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Vehicles
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data" id="vehicleForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Basic Information</h5>
                                
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" 
                                            id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="brand_id" class="form-label">Brand</label>
                                    <select class="form-select @error('brand_id') is-invalid @enderror" 
                                            id="brand_id" name="brand_id" required>
                                        <option value="">Select Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                           id="model" name="model" value="{{ old('model') }}" required>
                                    @error('model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                           id="year" name="year" value="{{ old('year') }}" 
                                           min="1900" max="{{ date('Y') + 1 }}" required>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="vin_number" class="form-label">VIN Number</label>
                                    <input type="text" class="form-control @error('vin_number') is-invalid @enderror" 
                                           id="vin_number" name="vin_number" value="{{ old('vin_number') }}" 
                                           maxlength="17" required>
                                    @error('vin_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-3">Specifications</h5>
                                
                                <div class="mb-3">
                                    <label for="mileage" class="form-label">Mileage</label>
                                    <input type="number" class="form-control @error('mileage') is-invalid @enderror" 
                                           id="mileage" name="mileage" value="{{ old('mileage') }}" 
                                           min="0" required>
                                    @error('mileage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="engine_size" class="form-label">Engine Size</label>
                                    <input type="number" step="0.1" class="form-control @error('engine_size') is-invalid @enderror" 
                                           id="engine_size" name="engine_size" value="{{ old('engine_size') }}" 
                                           min="0" required>
                                    @error('engine_size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="fuel_type" class="form-label">Fuel Type</label>
                                    <select class="form-select @error('fuel_type') is-invalid @enderror" 
                                            id="fuel_type" name="fuel_type" required>
                                        <option value="">Select Fuel Type</option>
                                        <option value="petrol" {{ old('fuel_type') == 'petrol' ? 'selected' : '' }}>Petrol</option>
                                        <option value="diesel" {{ old('fuel_type') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                        <option value="hybrid" {{ old('fuel_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                        <option value="electric" {{ old('fuel_type') == 'electric' ? 'selected' : '' }}>Electric</option>
                                        <option value="lpg" {{ old('fuel_type') == 'lpg' ? 'selected' : '' }}>LPG</option>
                                    </select>
                                    @error('fuel_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="transmission" class="form-label">Transmission</label>
                                    <select class="form-select @error('transmission') is-invalid @enderror" 
                                            id="transmission" name="transmission" required>
                                        <option value="">Select Transmission</option>
                                        <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : '' }}>Manual</option>
                                        <option value="automatic" {{ old('transmission') == 'automatic' ? 'selected' : '' }}>Automatic</option>
                                        <option value="semi-automatic" {{ old('transmission') == 'semi-automatic' ? 'selected' : '' }}>Semi-Automatic</option>
                                    </select>
                                    @error('transmission')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" class="form-control @error('color') is-invalid @enderror" 
                                           id="color" name="color" value="{{ old('color') }}" required>
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Pricing</h5>
                                
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                               id="price" name="price" value="{{ old('price') }}" 
                                               min="0" required>
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="sale_price" class="form-label">Sale Price (Optional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" class="form-control @error('sale_price') is-invalid @enderror" 
                                               id="sale_price" name="sale_price" value="{{ old('sale_price') }}" 
                                               min="0">
                                    </div>
                                    @error('sale_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                        <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>Reserved</option>
                                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-3">Rating & Discount</h5>
                                
                                <div class="mb-3">
                                    <label for="star_rating" class="form-label">Star Rating</label>
                                    <select class="form-select @error('star_rating') is-invalid @enderror" 
                                            id="star_rating" name="star_rating">
                                        <option value="0" {{ old('star_rating', 0) == 0 ? 'selected' : '' }}>No Rating</option>
                                        <option value="1" {{ old('star_rating') == 1 ? 'selected' : '' }}>1 Star</option>
                                        <option value="2" {{ old('star_rating') == 2 ? 'selected' : '' }}>2 Stars</option>
                                        <option value="3" {{ old('star_rating') == 3 ? 'selected' : '' }}>3 Stars</option>
                                        <option value="4" {{ old('star_rating') == 4 ? 'selected' : '' }}>4 Stars</option>
                                        <option value="5" {{ old('star_rating') == 5 ? 'selected' : '' }}>5 Stars</option>
                                    </select>
                                    @error('star_rating')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="discount_percentage" class="form-label">Discount Percentage</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control @error('discount_percentage') is-invalid @enderror" 
                                               id="discount_percentage" name="discount_percentage" value="{{ old('discount_percentage', 0) }}" 
                                               min="0" max="100">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('discount_percentage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="discount_start_date" class="form-label">Discount Start Date</label>
                                    <input type="date" class="form-control @error('discount_start_date') is-invalid @enderror" 
                                           id="discount_start_date" name="discount_start_date" value="{{ old('discount_start_date') }}">
                                    @error('discount_start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="discount_end_date" class="form-label">Discount End Date</label>
                                    <input type="date" class="form-control @error('discount_end_date') is-invalid @enderror" 
                                           id="discount_end_date" name="discount_end_date" value="{{ old('discount_end_date') }}">
                                    @error('discount_end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Categorization</h5>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_new_arrival" 
                                               name="is_new_arrival" value="1" {{ old('is_new_arrival') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_new_arrival">
                                            New Arrival
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_best_seller" 
                                               name="is_best_seller" value="1" {{ old('is_best_seller') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_best_seller">
                                            Best Seller
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_trending" 
                                               name="is_trending" value="1" {{ old('is_trending') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_trending">
                                            Trending
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_special_offer" 
                                               name="is_special_offer" value="1" {{ old('is_special_offer') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_special_offer">
                                            Special Offer
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_featured" 
                                               name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Featured Vehicle
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h5 class="mb-3">Images</h5>
                                
                                <!-- Image Upload Section -->
                                <div class="mb-3">
                                    <label for="images" class="form-label">Vehicle Images</label>
                                    <input type="file" class="form-control @error('images') is-invalid @enderror" 
                                           id="images" name="images[]" multiple accept="image/*">
                                    <div class="form-text">
                                        <strong>Enhanced Image Upload:</strong> You can now crop and adjust images before upload to ensure consistent aspect ratios. 
                                        Select multiple images (JPEG, PNG, JPG, GIF, WEBP). Maximum file size: 2MB per image.
                                    </div>
                                    @error('images')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @error('images.*')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    
                                    @if(session('upload_errors'))
                                        <div class="alert alert-danger mt-2">
                                            <strong>Upload Errors:</strong>
                                            <ul class="mb-0">
                                                @foreach(session('upload_errors') as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Image Cropper Modal -->
                                <div class="modal fade" id="imageCropperModal" tabindex="-1" aria-labelledby="imageCropperModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageCropperModalLabel">Crop Image</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="img-container">
                                                            <img id="cropperImage" src="" alt="Image to crop">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label">Aspect Ratio</label>
                                                            <select class="form-select" id="aspectRatio">
                                                                <option value="NaN">Free</option>
                                                                <option value="16/9" selected>16:9 (Landscape)</option>
                                                                <option value="4/3">4:3 (Standard)</option>
                                                                <option value="1/1">1:1 (Square)</option>
                                                                <option value="3/4">3:4 (Portrait)</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Actions</label>
                                                            <div class="d-grid gap-2">
                                                                <button type="button" class="btn btn-primary btn-sm" id="rotateLeft">
                                                                    <i class="fas fa-undo"></i> Rotate Left
                                                                </button>
                                                                <button type="button" class="btn btn-primary btn-sm" id="rotateRight">
                                                                    <i class="fas fa-redo"></i> Rotate Right
                                                                </button>
                                                                <button type="button" class="btn btn-secondary btn-sm" id="resetCrop">
                                                                    <i class="fas fa-refresh"></i> Reset
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Preview</label>
                                                            <div class="preview-container">
                                                                <div class="preview"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" id="cropImage">Crop & Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Cropped Images Preview -->
                                <div id="croppedImagesPreview" class="mt-3" style="display: none;">
                                    <h6>Cropped Images Preview:</h6>
                                    <div id="previewContainer" class="row g-2"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h5 class="mb-3">Description</h5>
                                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Vehicle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
<style>
.img-container {
    max-height: 400px;
    overflow: hidden;
}

.img-container img {
    max-width: 100%;
    max-height: 100%;
}

.preview-container {
    width: 100%;
    height: 150px;
    overflow: hidden;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.preview {
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.preview img {
    max-width: 100%;
    max-height: 100%;
}

#croppedImagesPreview .preview-item {
    position: relative;
    display: inline-block;
    margin: 5px;
}

#croppedImagesPreview .preview-item img {
    width: 100px;
    height: 75px;
    object-fit: cover;
    border-radius: 4px;
    border: 2px solid #ddd;
}

#croppedImagesPreview .remove-image {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 12px;
    cursor: pointer;
}

.cropper-container {
    max-height: 400px;
}
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
let cropper;
let currentFileIndex = 0;
let croppedImages = [];
let originalFiles = [];

document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('images');
    const cropperModal = new bootstrap.Modal(document.getElementById('imageCropperModal'));
    const cropperImage = document.getElementById('cropperImage');
    const aspectRatioSelect = document.getElementById('aspectRatio');
    const rotateLeftBtn = document.getElementById('rotateLeft');
    const rotateRightBtn = document.getElementById('rotateRight');
    const resetCropBtn = document.getElementById('resetCrop');
    const cropImageBtn = document.getElementById('cropImage');
    const previewContainer = document.getElementById('previewContainer');
    const croppedImagesPreview = document.getElementById('croppedImagesPreview');

    fileInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        if (files.length > 0) {
            originalFiles = files;
            currentFileIndex = 0;
            processNextImage();
        }
    });

    function processNextImage() {
        if (currentFileIndex >= originalFiles.length) {
            // All images processed, show preview
            showCroppedImagesPreview();
            return;
        }

        const file = originalFiles[currentFileIndex];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            cropperImage.src = e.target.result;
            cropperModal.show();
            
            // Initialize cropper after modal is shown
            setTimeout(() => {
                initCropper();
            }, 300);
        };
        
        reader.readAsDataURL(file);
    }

    function initCropper() {
        if (cropper) {
            cropper.destroy();
        }

        cropper = new Cropper(cropperImage, {
            aspectRatio: parseFloat(aspectRatioSelect.value) || NaN,
            viewMode: 2,
            dragMode: 'move',
            autoCropArea: 1,
            restore: false,
            guides: true,
            center: true,
            highlight: false,
            cropBoxMovable: true,
            cropBoxResizable: true,
            toggleDragModeOnDblclick: false,
            preview: '.preview'
        });
    }

    aspectRatioSelect.addEventListener('change', function() {
        if (cropper) {
            cropper.setAspectRatio(parseFloat(this.value) || NaN);
        }
    });

    rotateLeftBtn.addEventListener('click', function() {
        if (cropper) {
            cropper.rotate(-90);
        }
    });

    rotateRightBtn.addEventListener('click', function() {
        if (cropper) {
            cropper.rotate(90);
        }
    });

    resetCropBtn.addEventListener('click', function() {
        if (cropper) {
            cropper.reset();
        }
    });

    cropImageBtn.addEventListener('click', function() {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 800,
                height: 600,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high'
            });

            canvas.toBlob(function(blob) {
                // Create a new file from the cropped blob
                const croppedFile = new File([blob], originalFiles[currentFileIndex].name, {
                    type: originalFiles[currentFileIndex].type,
                    lastModified: Date.now()
                });

                croppedImages.push({
                    file: croppedFile,
                    originalIndex: currentFileIndex
                });

                cropperModal.hide();
                currentFileIndex++;
                
                // Process next image
                setTimeout(() => {
                    processNextImage();
                }, 500);
            }, originalFiles[currentFileIndex].type, 0.9);
        }
    });

    function showCroppedImagesPreview() {
        previewContainer.innerHTML = '';
        
        croppedImages.forEach((item, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'col-md-2 preview-item';
                previewItem.innerHTML = `
                    <img src="${e.target.result}" alt="Cropped image ${index + 1}">
                    <button type="button" class="remove-image" onclick="removeCroppedImage(${index})">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                previewContainer.appendChild(previewItem);
            };
            reader.readAsDataURL(item.file);
        });

        croppedImagesPreview.style.display = 'block';
    }

    // Add global function for removing images
    window.removeCroppedImage = function(index) {
        croppedImages.splice(index, 1);
        showCroppedImagesPreview();
    };

    // Handle form submission
    document.getElementById('vehicleForm').addEventListener('submit', function(e) {
        if (croppedImages.length > 0) {
            // Create a new FormData object
            const formData = new FormData(this);
            
            // Remove the original file input
            formData.delete('images[]');
            
            // Add cropped images
            croppedImages.forEach(item => {
                formData.append('images[]', item.file);
            });

            // Submit the form with cropped images
            e.preventDefault();
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while saving the vehicle.');
            });
        }
    });
});
</script>
@endsection
