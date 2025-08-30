<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the users for the role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the permissions for the role.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    /**
     * Assign a permission to the role.
     */
    public function assignPermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('slug', $permission)->firstOrFail();
        }
        
        $this->permissions()->syncWithoutDetaching($permission);
    }

    /**
     * Remove a permission from the role.
     */
    public function removePermission($permission)
    {
        if (is_string($permission)) {
            $permission = Permission::where('slug', $permission)->firstOrFail();
        }
        
        $this->permissions()->detach($permission);
    }

    /**
     * Check if role has a specific permission.
     */
    public function hasPermission($permission)
    {
        if (is_string($permission)) {
            return $this->permissions()->where('slug', $permission)->exists();
        }
        
        return $this->permissions()->where('id', $permission->id)->exists();
    }
}
