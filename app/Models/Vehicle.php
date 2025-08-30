<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'model',
        'year',
        'mileage',
        'price',
        'sale_price',
        'vin_number',
        'engine_size',
        'fuel_type',
        'transmission',
        'color',
        'interior_color',
        'features',
        'description',
        'status',
        'is_featured',
        'star_rating',
        'discount_percentage',
        'is_new_arrival',
        'is_best_seller',
        'is_trending',
        'is_special_offer',
        'discount_start_date',
        'discount_end_date',
        'created_by',
    ];

    protected $casts = [
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_new_arrival' => 'boolean',
        'is_best_seller' => 'boolean',
        'is_trending' => 'boolean',
        'is_special_offer' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'discount_start_date' => 'date',
        'discount_end_date' => 'date',
    ];

    /**
     * Get the category that owns the vehicle.
     */
    public function category()
    {
        return $this->belongsTo(VehicleCategory::class);
    }

    /**
     * Get the brand that owns the vehicle.
     */
    public function brand()
    {
        return $this->belongsTo(VehicleBrand::class);
    }

    /**
     * Get the user who created the vehicle.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the images for the vehicle.
     */
    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }

    /**
     * Get the primary image for the vehicle.
     */
    public function primaryImage()
    {
        return $this->hasOne(VehicleImage::class)->where('is_primary', true);
    }

    /**
     * Get the maintenance records for the vehicle.
     */
    public function maintenanceRecords()
    {
        return $this->hasMany(VehicleMaintenance::class);
    }

    /**
     * Get the sales leads for the vehicle.
     */
    public function salesLeads()
    {
        return $this->hasMany(SalesLead::class);
    }

    /**
     * Get the sales for the vehicle.
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get the financing applications for the vehicle.
     */
    public function financingApplications()
    {
        return $this->hasMany(FinancingApplication::class);
    }

    /**
     * Scope a query to only include available vehicles.
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Scope a query to only include vehicles that are not sold or out of stock.
     */
    public function scopeInStock($query)
    {
        return $query->whereNotIn('status', ['sold', 'out_of_stock']);
    }

    /**
     * Scope a query to only include featured vehicles.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include vehicles by brand.
     */
    public function scopeByBrand($query, $brandId)
    {
        return $query->where('brand_id', $brandId);
    }

    /**
     * Scope a query to only include vehicles by category.
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope a query to only include vehicles within a price range.
     */
    public function scopePriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    /**
     * Scope a query to only include new arrival vehicles.
     */
    public function scopeNewArrivals($query)
    {
        return $query->where('is_new_arrival', true);
    }

    /**
     * Scope a query to only include best seller vehicles.
     */
    public function scopeBestSellers($query)
    {
        return $query->where('is_best_seller', true);
    }

    /**
     * Scope a query to only include trending vehicles.
     */
    public function scopeTrending($query)
    {
        return $query->where('is_trending', true);
    }

    /**
     * Scope a query to only include special offer vehicles.
     */
    public function scopeSpecialOffers($query)
    {
        return $query->where('is_special_offer', true);
    }

    /**
     * Scope a query to only include vehicles with active discounts.
     */
    public function scopeWithActiveDiscounts($query)
    {
        $today = now()->toDateString();
        return $query->where('discount_percentage', '>', 0)
                    ->where(function($q) use ($today) {
                        $q->whereNull('discount_start_date')
                          ->orWhere('discount_start_date', '<=', $today);
                    })
                    ->where(function($q) use ($today) {
                        $q->whereNull('discount_end_date')
                          ->orWhere('discount_end_date', '>=', $today);
                    });
    }

    /**
     * Calculate the discounted price.
     */
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount_percentage > 0 && $this->isDiscountActive()) {
            return $this->price - ($this->price * $this->discount_percentage / 100);
        }
        return $this->price;
    }

    /**
     * Check if discount is currently active.
     */
    public function isDiscountActive()
    {
        $today = now()->toDateString();
        
        if ($this->discount_percentage <= 0) {
            return false;
        }

        if ($this->discount_start_date && $this->discount_start_date > $today) {
            return false;
        }

        if ($this->discount_end_date && $this->discount_end_date < $today) {
            return false;
        }

        return true;
    }
}
