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
     * Prevent the user with `superadmin` role from being queried.
     */
    public function scopeExceptSuperAdmin($query)
    {
        return $query->where('name', '!=', config('roles.default.superadmin.name'));
    }
}
