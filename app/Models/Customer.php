<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'city',
        'state',
        'zip_code',
        'age',
        'status',
        'district',
        'driver_license_number',
    ];

    protected $casts = [
        'age' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function salesLeads()
    {
        return $this->hasMany(SalesLead::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function financingApplications()
    {
        return $this->hasMany(FinancingApplication::class);
    }

    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
