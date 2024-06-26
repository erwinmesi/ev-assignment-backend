<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
    ];

    protected $appends = [
        'fullname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Roles associated with the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, UserRole::class);
    }

    /**
     * Prevent the user with `superadmin` role from being queried.
     */
    public function scopeExceptSuperAdmin()
    {
        return $this->whereDoesntHave('roles', function ($query) {
            $query->where('name', config('roles.default.superadmin.name'));
        });
    }

    /**
     * Get the user's full name.
     */
    public function getFullnameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
