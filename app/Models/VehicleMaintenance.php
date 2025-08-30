<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleMaintenance extends Model
{
    protected $table = 'vehicle_maintenance';

    protected $fillable = [
        'vehicle_id',
        'service_type',
        'description',
        'cost',
        'service_date',
        'next_service_date',
        'performed_by'
    ];

    protected $casts = [
        'service_date' => 'date',
        'next_service_date' => 'date',
        'cost' => 'decimal:2'
    ];

    /**
     * Get the vehicle that owns the maintenance record.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the user who performed the maintenance.
     */
    public function performer()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
