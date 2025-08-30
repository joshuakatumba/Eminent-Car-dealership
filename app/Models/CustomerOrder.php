<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'contact_number',
        'vehicle_id',
        'vehicle_info',
        'status',
        'notes'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
