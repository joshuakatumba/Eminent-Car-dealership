<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleBrand;
use App\Models\VehicleImage;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vehicles = Vehicle::with(['category', 'brand', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $categories = VehicleCategory::where('is_active', true)->get();
        $brands = VehicleBrand::where('is_active', true)->get();

        return view('admin.vehicles.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:vehicle_categories,id',
            'brand_id' => 'required|exists:vehicle_brands,id',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'vin_number' => 'required|string|max:17|unique:vehicles',
            'engine_size' => 'nullable|string|max:50',
            'fuel_type' => 'required|in:gasoline,diesel,electric,hybrid',
            'transmission' => 'required|in:automatic,manual,cvt',
            'color' => 'required|string|max:50',
            'interior_color' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'star_rating' => 'nullable|integer|min:0|max:5',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'is_new_arrival' => 'boolean',
            'is_best_seller' => 'boolean',
            'is_trending' => 'boolean',
            'is_special_offer' => 'boolean',
            'discount_start_date' => 'nullable|date',
            'discount_end_date' => 'nullable|date|after_or_equal:discount_start_date',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $vehicle = Vehicle::create($request->all() + [
            'created_by' => auth()->id(),
            'status' => 'available',
        ]);

        // Log the vehicle creation
        ActivityService::logCreate($vehicle, "Created new vehicle: {$vehicle->brand->name} {$vehicle->model} ({$vehicle->year})");

        // Handle image uploads
        if ($request->hasFile('images')) {
            try {
                $uploadResult = $this->uploadImages($vehicle, $request->file('images'));
                
                if (!empty($uploadResult['errors'])) {
                    return redirect()->back()
                        ->withInput()
                        ->with('upload_errors', $uploadResult['errors'])
                        ->withErrors(['images' => 'Some images failed to upload. See details below.']);
                }
                
                if ($uploadResult['uploaded'] > 0) {
                    $message = "Vehicle created successfully!";
                    if ($uploadResult['uploaded'] > 1) {
                        $message .= " {$uploadResult['uploaded']} images uploaded.";
                    } else {
                        $message .= " 1 image uploaded.";
                    }
                    return redirect()->route('admin.vehicles.index')->with('success', $message);
                }
            } catch (\Exception $e) {
                \Log::error('Error in vehicle image upload: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['images' => 'An error occurred while uploading images. Please try again.']);
            }
        }

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle created successfully!');
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['category', 'brand', 'creator', 'images', 'maintenanceRecords']);
        
        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        $categories = VehicleCategory::where('is_active', true)->get();
        $brands = VehicleBrand::where('is_active', true)->get();

        return view('admin.vehicles.edit', compact('vehicle', 'categories', 'brands'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'category_id' => 'required|exists:vehicle_categories,id',
            'brand_id' => 'required|exists:vehicle_brands,id',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'vin_number' => 'required|string|max:17|unique:vehicles,vin_number,' . $vehicle->id,
            'engine_size' => 'nullable|string|max:50',
            'fuel_type' => 'required|in:gasoline,diesel,electric,hybrid',
            'transmission' => 'required|in:automatic,manual,cvt',
            'color' => 'required|string|max:50',
            'interior_color' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'status' => 'required|in:available,sold,reserved,booked,out_of_stock,maintenance',
            'is_featured' => 'boolean',
            'star_rating' => 'nullable|integer|min:0|max:5',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'is_new_arrival' => 'boolean',
            'is_best_seller' => 'boolean',
            'is_trending' => 'boolean',
            'is_special_offer' => 'boolean',
            'discount_start_date' => 'nullable|date',
            'discount_end_date' => 'nullable|date|after_or_equal:discount_start_date',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $vehicle->update($request->all());

        // Log the vehicle update
        ActivityService::logUpdate($vehicle, "Updated vehicle: {$vehicle->brand->name} {$vehicle->model} ({$vehicle->year})");

        // Handle image uploads
        if ($request->hasFile('images')) {
            \Log::info('Files detected: ' . count($request->file('images')));
            try {
                $uploadResult = $this->uploadImages($vehicle, $request->file('images'));
                
                if (!empty($uploadResult['errors'])) {
                    return redirect()->back()
                        ->withInput()
                        ->with('upload_errors', $uploadResult['errors'])
                        ->withErrors(['images' => 'Some images failed to upload. See details below.']);
                }
                
                if ($uploadResult['uploaded'] > 0) {
                    $message = "Vehicle updated successfully!";
                    if ($uploadResult['uploaded'] > 1) {
                        $message .= " {$uploadResult['uploaded']} images uploaded.";
                    } else {
                        $message .= " 1 image uploaded.";
                    }
                    return redirect()->route('admin.vehicles.index')->with('success', $message);
                }
            } catch (\Exception $e) {
                \Log::error('Error in vehicle image upload: ' . $e->getMessage());
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['images' => 'An error occurred while uploading images. Please try again.']);
            }
        } else {
            \Log::info('No files detected in request');
        }

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle updated successfully!');
    }

    public function destroy(Vehicle $vehicle)
    {
        // Log the vehicle deletion before deleting
        ActivityService::logDelete($vehicle, "Deleted vehicle: {$vehicle->brand->name} {$vehicle->model} ({$vehicle->year})");

        // Delete associated images
        foreach ($vehicle->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Vehicle deleted successfully!');
    }

    /**
     * Upload images for a vehicle
     */
    private function uploadImages(Vehicle $vehicle, $images)
    {
        $sortOrder = $vehicle->images()->max('sort_order') ?? 0;
        $uploadedCount = 0;
        $errors = [];
        
        foreach ($images as $index => $image) {
            try {
                // Log file details for debugging
                \Log::info("Processing image " . ($index + 1) . ": " . $image->getClientOriginalName());
                \Log::info("File size: " . $image->getSize() . " bytes");
                \Log::info("MIME type: " . $image->getMimeType());
                \Log::info("Extension: " . $image->getClientOriginalExtension());
                
                // Validate individual image
                if (!$image->isValid()) {
                    $errorMsg = $image->getErrorMessage();
                    $errors[] = "Image " . ($index + 1) . " failed to upload: " . $errorMsg;
                    \Log::error("Image validation failed: " . $errorMsg);
                    continue;
                }
                
                // Check file size
                if ($image->getSize() > 2048 * 1024) { // 2MB in bytes
                    $errors[] = "Image " . ($index + 1) . " is too large. Maximum size is 2MB.";
                    continue;
                }
                
                // Enhanced file type checking
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                $mimeType = $image->getMimeType();
                $extension = strtolower($image->getClientOriginalExtension());
                
                // Check both MIME type and extension
                $validMimeType = in_array($mimeType, $allowedTypes);
                $validExtension = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                
                if (!$validMimeType || !$validExtension) {
                    $errors[] = "Image " . ($index + 1) . " has an unsupported format. MIME: {$mimeType}, Extension: {$extension}. Allowed: JPEG, PNG, JPG, GIF, WEBP.";
                    \Log::warning("Invalid file type - MIME: {$mimeType}, Extension: {$extension}");
                    continue;
                }
                
                // Additional validation: check if file is actually an image
                if (!getimagesize($image->getPathname())) {
                    $errors[] = "Image " . ($index + 1) . " is not a valid image file.";
                    \Log::warning("File is not a valid image: " . $image->getClientOriginalName());
                    continue;
                }
                
                $sortOrder++;
                
                // Enhanced filename sanitization
                $originalName = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);
                $sanitizedName = preg_replace('/[^a-zA-Z0-9._-]/', '', $nameWithoutExt);
                $filename = time() . '_' . $sanitizedName . '.' . $extension;
                
                // Create directory if it doesn't exist
                $directory = 'vehicles/' . $vehicle->id;
                if (!Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory);
                }
                
                // Try to store the file
                $path = $image->storeAs($directory, $filename, 'public');
                
                if (!$path) {
                    $errors[] = "Failed to store image " . ($index + 1) . ": " . $originalName;
                    \Log::error("Failed to store image: " . $originalName);
                    continue;
                }
                
                // Verify the file was actually stored
                if (!Storage::disk('public')->exists($path)) {
                    $errors[] = "Image " . ($index + 1) . " was not stored properly: " . $originalName;
                    \Log::error("File not found after storage: " . $path);
                    continue;
                }
                
                VehicleImage::create([
                    'vehicle_id' => $vehicle->id,
                    'image_path' => $path,
                    'image_name' => $originalName,
                    'is_primary' => $vehicle->images()->count() === 0, // First image is primary
                    'sort_order' => $sortOrder
                ]);
                
                $uploadedCount++;
                \Log::info('Image uploaded successfully: ' . $path);
            } catch (\Exception $e) {
                $errors[] = "Error uploading image " . ($index + 1) . ": " . $e->getMessage();
                \Log::error('Error uploading image: ' . $e->getMessage() . ' - File: ' . $image->getClientOriginalName());
            }
        }
        
        // Log results
        if ($uploadedCount > 0) {
            \Log::info("Successfully uploaded {$uploadedCount} images for vehicle {$vehicle->id}");
        }
        
        if (!empty($errors)) {
            \Log::warning("Image upload errors for vehicle {$vehicle->id}: " . implode(', ', $errors));
        }
        
        return [
            'uploaded' => $uploadedCount,
            'errors' => $errors
        ];
    }

    /**
     * Delete a specific image
     */
    public function deleteImage(Vehicle $vehicle, VehicleImage $image)
    {
        if ($image->vehicle_id !== $vehicle->id) {
            abort(404);
        }

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        // If this was the primary image, make the next one primary
        if ($image->is_primary) {
            $nextImage = $vehicle->images()->where('id', '!=', $image->id)->first();
            if ($nextImage) {
                $nextImage->update(['is_primary' => true]);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Set an image as primary
     */
    public function setPrimaryImage(Vehicle $vehicle, VehicleImage $image)
    {
        if ($image->vehicle_id !== $vehicle->id) {
            abort(404);
        }

        // Remove primary from all other images
        $vehicle->images()->update(['is_primary' => false]);
        
        // Set this image as primary
        $image->update(['is_primary' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Update image order
     */
    public function updateImageOrder(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'imageOrder' => 'required|array',
            'imageOrder.*' => 'integer|exists:vehicle_images,id'
        ]);

        $imageOrder = $request->input('imageOrder');
        
        // Update sort_order for each image
        foreach ($imageOrder as $index => $imageId) {
            VehicleImage::where('id', $imageId)
                ->where('vehicle_id', $vehicle->id)
                ->update(['sort_order' => $index + 1]);
        }

        // Log the activity
        ActivityService::logUpdate($vehicle, "Updated image order for vehicle: {$vehicle->brand->name} {$vehicle->model}");

        return response()->json(['success' => true]);
    }
}
