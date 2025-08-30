@extends('admin.layouts.app')

@section('title', 'Edit Vehicle')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Edit Vehicle: {{ $vehicle->brand->name }} {{ $vehicle->model }}</h4>
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Vehicles
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Basic Information</h5>
                                
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" 
                                            id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ old('category_id', $vehicle->category_id) == $category->id ? 'selected' : '' }}>
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
                                            <option value="{{ $brand->id }}" 
                                                {{ old('brand_id', $vehicle->brand_id) == $brand->id ? 'selected' : '' }}>
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
                                           id="model" name="model" value="{{ old('model', $vehicle->model) }}" required>
                                    @error('model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                           id="year" name="year" value="{{ old('year', $vehicle->year) }}" 
                                           min="1900" max="{{ date('Y') + 1 }}" required>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="vin_number" class="form-label">VIN Number</label>
                                    <input type="text" class="form-control @error('vin_number') is-invalid @enderror" 
                                           id="vin_number" name="vin_number" value="{{ old('vin_number', $vehicle->vin_number) }}" 
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
                                           id="mileage" name="mileage" value="{{ old('mileage', $vehicle->mileage) }}" 
                                           min="0" required>
                                    @error('mileage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="engine_size" class="form-label">Engine Size</label>
                                    <input type="text" class="form-control @error('engine_size') is-invalid @enderror" 
                                           id="engine_size" name="engine_size" value="{{ old('engine_size', $vehicle->engine_size) }}">
                                    @error('engine_size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="fuel_type" class="form-label">Fuel Type</label>
                                    <select class="form-select @error('fuel_type') is-invalid @enderror" 
                                            id="fuel_type" name="fuel_type" required>
                                        <option value="">Select Fuel Type</option>
                                        <option value="gasoline" {{ old('fuel_type', $vehicle->fuel_type) == 'gasoline' ? 'selected' : '' }}>Gasoline</option>
                                        <option value="diesel" {{ old('fuel_type', $vehicle->fuel_type) == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                        <option value="electric" {{ old('fuel_type', $vehicle->fuel_type) == 'electric' ? 'selected' : '' }}>Electric</option>
                                        <option value="hybrid" {{ old('fuel_type', $vehicle->fuel_type) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
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
                                        <option value="automatic" {{ old('transmission', $vehicle->transmission) == 'automatic' ? 'selected' : '' }}>Automatic</option>
                                        <option value="manual" {{ old('transmission', $vehicle->transmission) == 'manual' ? 'selected' : '' }}>Manual</option>
                                        <option value="cvt" {{ old('transmission', $vehicle->transmission) == 'cvt' ? 'selected' : '' }}>CVT</option>
                                    </select>
                                    @error('transmission')
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
                                        <span class="input-group-text">UGX</span>
                                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                               id="price" name="price" value="{{ old('price', $vehicle->price) }}" min="0" required>
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="sale_price" class="form-label">Sale Price (Optional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">UGX</span>
                                        <input type="number" step="0.01" class="form-control @error('sale_price') is-invalid @enderror" 
                                               id="sale_price" name="sale_price" value="{{ old('sale_price', $vehicle->sale_price) }}" min="0">
                                    </div>
                                    @error('sale_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-3">Appearance & Status</h5>
                                
                                <div class="mb-3">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" class="form-control @error('color') is-invalid @enderror" 
                                           id="color" name="color" value="{{ old('color', $vehicle->color) }}" required>
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="interior_color" class="form-label">Interior Color</label>
                                    <input type="text" class="form-control @error('interior_color') is-invalid @enderror" 
                                           id="interior_color" name="interior_color" value="{{ old('interior_color', $vehicle->interior_color) }}">
                                    @error('interior_color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="available" {{ old('status', $vehicle->status) == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="sold" {{ old('status', $vehicle->status) == 'sold' ? 'selected' : '' }}>Sold</option>
                                        <option value="reserved" {{ old('status', $vehicle->status) == 'reserved' ? 'selected' : '' }}>Reserved</option>
                                        <option value="booked" {{ old('status', $vehicle->status) == 'booked' ? 'selected' : '' }}>Booked</option>
                                        <option value="out_of_stock" {{ old('status', $vehicle->status) == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                        <option value="maintenance" {{ old('status', $vehicle->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_featured" 
                                               name="is_featured" value="1" {{ old('is_featured', $vehicle->is_featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Featured Vehicle
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Rating & Discount</h5>
                                
                                <div class="mb-3">
                                    <label for="star_rating" class="form-label">Star Rating</label>
                                    <select class="form-select @error('star_rating') is-invalid @enderror" 
                                            id="star_rating" name="star_rating">
                                        <option value="0" {{ old('star_rating', $vehicle->star_rating) == 0 ? 'selected' : '' }}>No Rating</option>
                                        <option value="1" {{ old('star_rating', $vehicle->star_rating) == 1 ? 'selected' : '' }}>1 Star</option>
                                        <option value="2" {{ old('star_rating', $vehicle->star_rating) == 2 ? 'selected' : '' }}>2 Stars</option>
                                        <option value="3" {{ old('star_rating', $vehicle->star_rating) == 3 ? 'selected' : '' }}>3 Stars</option>
                                        <option value="4" {{ old('star_rating', $vehicle->star_rating) == 4 ? 'selected' : '' }}>4 Stars</option>
                                        <option value="5" {{ old('star_rating', $vehicle->star_rating) == 5 ? 'selected' : '' }}>5 Stars</option>
                                    </select>
                                    @error('star_rating')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="discount_percentage" class="form-label">Discount Percentage</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" class="form-control @error('discount_percentage') is-invalid @enderror" 
                                               id="discount_percentage" name="discount_percentage" 
                                               value="{{ old('discount_percentage', $vehicle->discount_percentage) }}" 
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
                                           id="discount_start_date" name="discount_start_date" 
                                           value="{{ old('discount_start_date', $vehicle->discount_start_date) }}">
                                    @error('discount_start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="discount_end_date" class="form-label">Discount End Date</label>
                                    <input type="date" class="form-control @error('discount_end_date') is-invalid @enderror" 
                                           id="discount_end_date" name="discount_end_date" 
                                           value="{{ old('discount_end_date', $vehicle->discount_end_date) }}">
                                    @error('discount_end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-3">Categorization</h5>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_new_arrival" 
                                               name="is_new_arrival" value="1" {{ old('is_new_arrival', $vehicle->is_new_arrival) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_new_arrival">
                                            New Arrival
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_best_seller" 
                                               name="is_best_seller" value="1" {{ old('is_best_seller', $vehicle->is_best_seller) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_best_seller">
                                            Best Seller
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_trending" 
                                               name="is_trending" value="1" {{ old('is_trending', $vehicle->is_trending) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_trending">
                                            Trending
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_special_offer" 
                                               name="is_special_offer" value="1" {{ old('is_special_offer', $vehicle->is_special_offer) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_special_offer">
                                            Special Offer
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h5 class="mb-3">Images</h5>
                                
                                @if($vehicle->images->count() > 0)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="form-label mb-0">Current Images</label>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary" id="previewQuickView" data-vehicle-id="{{ $vehicle->id }}">
                                                <i class="fas fa-eye"></i> Preview Quick View
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" id="reorderImages">
                                                <i class="fas fa-sort"></i> Reorder
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row" id="imageGrid">
                                        @foreach($vehicle->images as $image)
                                        <div class="col-md-3 mb-3 image-item" data-image-id="{{ $image->id }}" draggable="true">
                                            <div class="card">
                                                <div class="image-preview position-relative">
                                                    <img src="{{ $image->image_url }}" class="card-img-top" alt="Vehicle Image">
                                                    <div class="image-overlay">
                                                        <div class="image-actions">
                                                            @if($image->is_primary)
                                                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Primary</span>
                                                            @else
                                                                <button type="button" class="btn btn-sm btn-outline-primary set-primary" 
                                                                        data-image-id="{{ $image->id }}" data-vehicle-id="{{ $vehicle->id }}">
                                                                    Set Primary
                                                                </button>
                                                            @endif
                                                            <button type="button" class="btn btn-sm btn-outline-danger delete-image" 
                                                                    data-image-id="{{ $image->id }}" data-vehicle-id="{{ $vehicle->id }}">
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body p-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">Image {{ $loop->iteration }}</small>
                                                        <div class="image-order-badge">{{ $loop->iteration }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                
                                <div class="mb-3">
                                    <label for="images" class="form-label">Add New Images</label>
                                    <input type="file" class="form-control @error('images') is-invalid @enderror" 
                                           id="images" name="images[]" multiple accept="image/*">
                                    <div class="form-text">
                                        <strong>Enhanced Image Upload:</strong> You can now crop and adjust images before upload to ensure consistent aspect ratios. 
                                        Select multiple images (JPEG, PNG, JPG, GIF, WEBP) to add to the existing ones. Maximum file size: 2MB per image.
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
                                    <h6>New Cropped Images Preview:</h6>
                                    <div id="previewContainer" class="row g-2"></div>
                                </div>
                                
                                <!-- Quick View Preview Modal -->
                                <div class="modal fade" id="adminQuickViewPreviewModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-eye"></i> Quick View Preview
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle"></i> This is exactly how customers will see your vehicle in the Quick View modal.
                                                </div>
                                                <div id="adminQuickViewContent">
                                                    <!-- Quick View content will be loaded here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <h5 class="mb-3">Description</h5>
                                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="4">{{ old('description', $vehicle->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Vehicle
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

/* Admin Image Management Styles */
.image-preview {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-item:hover .image-overlay {
    opacity: 1;
}

.image-actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
    align-items: center;
}

.image-order-badge {
    background: #007bff;
    color: white;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
}

/* Reorder Mode Styles */
.reorder-mode .image-item {
    cursor: grab;
    transition: transform 0.2s ease;
}

.reorder-mode .image-item:hover {
    transform: scale(1.02);
}

.reorder-mode .image-item.dragging {
    cursor: grabbing;
    opacity: 0.5;
    transform: rotate(5deg);
}

.reorder-mode .image-overlay {
    display: none;
}

/* Quick View Preview Styles */
#adminQuickViewContent .quick-view-slideshow {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 15px;
    background: #f8f9fa;
}

#adminQuickViewContent .slideshow-wrapper {
    height: 300px;
}

#adminQuickViewContent .thumbnail {
    width: 60px;
    height: 45px;
}

#adminQuickViewContent .product-info {
    background: white;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #e9ecef;
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

    // Handle form submission for new images
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
                alert('An error occurred while updating the vehicle.');
            });
        }
    });

    // Admin Quick View Preview Functionality
    document.getElementById('previewQuickView').addEventListener('click', function() {
        const vehicleId = this.dataset.vehicleId;
        loadAdminQuickViewPreview(vehicleId);
    });

    function loadAdminQuickViewPreview(vehicleId) {
        const previewModal = new bootstrap.Modal(document.getElementById('adminQuickViewPreviewModal'));
        const contentDiv = document.getElementById('adminQuickViewContent');
        
        // Show loading state
        contentDiv.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3">Loading Quick View Preview...</p>
            </div>
        `;
        
        previewModal.show();
        
        // Fetch vehicle data
        fetch(`/api/vehicles/${vehicleId}/quick-view`)
            .then(response => response.json())
            .then(data => {
                // Create a mini version of the Quick View modal
                const quickViewHTML = createAdminQuickViewHTML(data);
                contentDiv.innerHTML = quickViewHTML;
                
                // Initialize the mini slideshow
                initializeAdminSlideshow();
            })
            .catch(error => {
                console.error('Error loading Quick View preview:', error);
                contentDiv.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i> Failed to load Quick View preview.
                    </div>
                `;
            });
    }

    function createAdminQuickViewHTML(vehicle) {
        const images = vehicle.images || [];
        const slidesHTML = images.map((image, index) => `
            <div class="slide ${index === 0 ? 'active' : ''}" data-index="${index}">
                <img src="${image.image_url}" alt="Vehicle image ${index + 1}" class="main-image">
            </div>
        `).join('');
        
        const thumbnailsHTML = images.map((image, index) => `
            <div class="thumbnail ${index === 0 ? 'active' : ''}" data-index="${index}">
                <img src="${image.image_url}" alt="Vehicle thumbnail ${index + 1}">
            </div>
        `).join('');
        
        return `
            <div class="row g-4">
                <div class="col-12 col-xl-7">
                    <div class="quick-view-slideshow">
                        <div class="main-image-container">
                            <div class="slideshow-wrapper">
                                <div class="slideshow-container" id="adminSlideshowContainer">
                                    ${slidesHTML || '<div class="slide active"><img src="/assets/images/placeholder-vehicle.svg" alt="Vehicle" class="main-image"></div>'}
                                </div>
                                <button class="slideshow-nav prev" id="adminPrevBtn">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button class="slideshow-nav next" id="adminNextBtn">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                                <div class="image-counter">
                                    <span id="adminCurrentImage">1</span> / <span id="adminTotalImages">${images.length || 1}</span>
                                </div>
                            </div>
                        </div>
                        <div class="thumbnail-container">
                            <div class="thumbnail-wrapper" id="adminThumbnailWrapper">
                                ${thumbnailsHTML || '<div class="thumbnail active"><img src="/assets/images/placeholder-vehicle.svg" alt="Vehicle thumbnail"></div>'}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-5">
                    <div class="product-info">
                        <h4 class="product-title fw-bold mb-1">${vehicle.brand?.name || ''} ${vehicle.model || ''}</h4>
                        <p class="mb-0 text-muted">${vehicle.description || 'Vehicle description'}</p>
                        
                        <div class="product-rating">
                            <div class="hstack gap-2 border p-1 mt-3 width-content">
                                <div><span class="rating-number">${vehicle.star_rating || 0}</span><i class="bi bi-star-fill ms-1 text-warning"></i></div>
                                <div class="vr"></div>
                                <div>${vehicle.star_rating ? vehicle.star_rating * 20 : 0} Ratings</div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="product-price d-flex align-items-center gap-3">
                            <div class="h4 fw-bold text-primary">UGX ${vehicle.sale_price ? vehicle.sale_price.toLocaleString() : vehicle.price.toLocaleString()}</div>
                            ${vehicle.sale_price ? `<div class="h5 fw-light text-muted text-decoration-line-through">UGX ${vehicle.price.toLocaleString()}</div>` : ''}
                        </div>
                        
                        <div class="vehicle-specs mt-3">
                            <h6 class="fw-bold mb-3">Vehicle Specifications</h6>
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Year:</span>
                                        <span class="fw-bold">${vehicle.year || '-'}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Mileage:</span>
                                        <span class="fw-bold">${vehicle.mileage ? vehicle.mileage.toLocaleString() + ' km' : '-'}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Fuel Type:</span>
                                        <span class="fw-bold">${vehicle.fuel_type ? vehicle.fuel_type.charAt(0).toUpperCase() + vehicle.fuel_type.slice(1) : '-'}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Transmission:</span>
                                        <span class="fw-bold">${vehicle.transmission ? vehicle.transmission.charAt(0).toUpperCase() + vehicle.transmission.slice(1) : '-'}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function initializeAdminSlideshow() {
        const slides = document.querySelectorAll('#adminSlideshowContainer .slide');
        const thumbnails = document.querySelectorAll('#adminThumbnailWrapper .thumbnail');
        let currentIndex = 0;
        const totalSlides = slides.length;

        function goToSlide(index) {
            if (index < 0 || index >= totalSlides) return;
            
            slides[currentIndex].classList.remove('active');
            thumbnails[currentIndex].classList.remove('active');
            
            slides[index].classList.add('active');
            thumbnails[index].classList.add('active');
            
            currentIndex = index;
            document.getElementById('adminCurrentImage').textContent = currentIndex + 1;
        }

        function nextSlide() {
            const nextIndex = (currentIndex + 1) % totalSlides;
            goToSlide(nextIndex);
        }

        function previousSlide() {
            const prevIndex = currentIndex === 0 ? totalSlides - 1 : currentIndex - 1;
            goToSlide(prevIndex);
        }

        // Add event listeners
        document.getElementById('adminPrevBtn').addEventListener('click', previousSlide);
        document.getElementById('adminNextBtn').addEventListener('click', nextSlide);
        
        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', () => goToSlide(index));
        });
    }

    // Image Reordering Functionality
    let isReorderMode = false;
    
    document.getElementById('reorderImages').addEventListener('click', function() {
        isReorderMode = !isReorderMode;
        const imageGrid = document.getElementById('imageGrid');
        const reorderBtn = this;
        
        if (isReorderMode) {
            imageGrid.classList.add('reorder-mode');
            reorderBtn.innerHTML = '<i class="fas fa-save"></i> Save Order';
            reorderBtn.classList.remove('btn-outline-secondary');
            reorderBtn.classList.add('btn-success');
            
            // Enable drag and drop
            enableImageReordering();
        } else {
            imageGrid.classList.remove('reorder-mode');
            reorderBtn.innerHTML = '<i class="fas fa-sort"></i> Reorder';
            reorderBtn.classList.remove('btn-success');
            reorderBtn.classList.add('btn-outline-secondary');
            
            // Save the new order
            saveImageOrder();
        }
    });

    function enableImageReordering() {
        const imageItems = document.querySelectorAll('.image-item');
        
        imageItems.forEach(item => {
            item.addEventListener('dragstart', handleDragStart);
            item.addEventListener('dragover', handleDragOver);
            item.addEventListener('drop', handleDrop);
            item.addEventListener('dragend', handleDragEnd);
        });
    }

    function handleDragStart(e) {
        e.target.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', e.target.outerHTML);
    }

    function handleDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
    }

    function handleDrop(e) {
        e.preventDefault();
        const draggedItem = document.querySelector('.dragging');
        const dropTarget = e.target.closest('.image-item');
        
        if (draggedItem && dropTarget && draggedItem !== dropTarget) {
            const allItems = [...document.querySelectorAll('.image-item')];
            const draggedIndex = allItems.indexOf(draggedItem);
            const dropIndex = allItems.indexOf(dropTarget);
            
            if (draggedIndex < dropIndex) {
                dropTarget.parentNode.insertBefore(draggedItem, dropTarget.nextSibling);
            } else {
                dropTarget.parentNode.insertBefore(draggedItem, dropTarget);
            }
            
            updateImageOrderNumbers();
        }
    }

    function handleDragEnd(e) {
        e.target.classList.remove('dragging');
    }

    function updateImageOrderNumbers() {
        const imageItems = document.querySelectorAll('.image-item');
        imageItems.forEach((item, index) => {
            const badge = item.querySelector('.image-order-badge');
            if (badge) {
                badge.textContent = index + 1;
            }
        });
    }

    function saveImageOrder() {
        const imageItems = document.querySelectorAll('.image-item');
        const imageOrder = Array.from(imageItems).map(item => item.dataset.imageId);
        const vehicleId = document.querySelector('#previewQuickView').dataset.vehicleId;
        
        fetch(`/admin/vehicles/${vehicleId}/update-image-order`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ imageOrder })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', 'Image order updated successfully!');
            } else {
                showAlert('error', 'Failed to update image order.');
            }
        })
        .catch(error => {
            console.error('Error updating image order:', error);
            showAlert('error', 'An error occurred while updating image order.');
        });
    }

    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.querySelector('.card-body').insertBefore(alertDiv, document.querySelector('.card-body').firstChild);
        
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }

    // Handle delete image
    document.querySelectorAll('.delete-image').forEach(function(button) {
        button.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this image?')) {
                const imageId = this.dataset.imageId;
                const vehicleId = this.dataset.vehicleId;
                
                fetch(`/admin/vehicles/${vehicleId}/images/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.closest('.col-md-3').remove();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting image');
                });
            }
        });
    });

    // Handle set primary image
    document.querySelectorAll('.set-primary').forEach(function(button) {
        button.addEventListener('click', function() {
            const imageId = this.dataset.imageId;
            const vehicleId = this.dataset.vehicleId;
            
            fetch(`/admin/vehicles/${vehicleId}/images/${imageId}/primary`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Reload to update the UI
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error setting primary image');
            });
        });
    });
});
</script>
@endsection
