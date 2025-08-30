<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'salesperson_id',
        'sale_date',
        'sale_price',
        'down_payment',
        'financing_amount',
        'trade_in_value',
        'tax_amount',
        'total_amount',
        'payment_method',
        'status',
        'notes',
    ];

    protected $casts = [
        'sale_date' => 'date',
        'sale_price' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'financing_amount' => 'decimal:2',
        'trade_in_value' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function salesperson()
    {
        return $this->belongsTo(User::class, 'salesperson_id');
    }
}
