<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone',
        'address',
        'profile_image',
        'is_active',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    /**
     * Get the role that owns the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the permissions for the user through their role.
     */
    public function permissions()
    {
        return $this->role->permissions ?? collect();
    }

    /**
     * Check if user has a specific permission.
     */
    public function hasPermission($permission)
    {
        return $this->permissions()->contains('slug', $permission);
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole($role)
    {
        return $this->role && $this->role->name === $role;
    }

    /**
     * Get vehicles created by this user.
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'created_by');
    }

    /**
     * Get sales leads assigned to this user.
     */
    public function assignedLeads()
    {
        return $this->hasMany(SalesLead::class, 'assigned_to');
    }

    /**
     * Get sales made by this user.
     */
    public function sales()
    {
        return $this->hasMany(Sale::class, 'salesperson_id');
    }

    /**
     * Get financing applications approved by this user.
     */
    public function approvedApplications()
    {
        return $this->hasMany(FinancingApplication::class, 'approved_by');
    }

    /**
     * Get blog posts authored by this user.
     */
    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    /**
     * Get support tickets assigned to this user.
     */
    public function assignedTickets()
    {
        return $this->hasMany(SupportTicket::class, 'assigned_to');
    }

    /**
     * Get ticket responses by this user.
     */
    public function ticketResponses()
    {
        return $this->hasMany(TicketResponse::class);
    }

    /**
     * Get maintenance records performed by this user.
     */
    public function maintenanceRecords()
    {
        return $this->hasMany(VehicleMaintenance::class, 'performed_by');
    }

    /**
     * Get activity logs for this user.
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
