<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Fortify\TwoFactorAuthenticatable;

use App\Models\Users\Orders;
use App\Models\Users\Products;
use App\Models\Users\Replies;
use App\Models\Users\MarketMonitoring;
use App\Models\Profile;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasProfilePhoto, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_seller',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_seller' => 'boolean', // ✅ auto true/false instead of 0/1
    ];

    /**
     * The attributes that should be appended to JSON.
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? asset('storage/' . $this->profile_photo_path)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=0D8ABC&color=fff';
    }

    // ✅ Relationships
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasAnyRoles($roles)
    {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'user_id');
    }

    public function reviewReplies()
    {
        return $this->hasMany(Replies::class);
    }

    public function ordersPlaced()
    {
        return $this->hasMany(Orders::class, 'user_id');
    }

    public function ordersReceived()
    {
        return $this->hasMany(Orders::class, 'seller_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }

    public function marketLogs()
    {
        return $this->hasManyThrough(MarketMonitoring::class, Products::class, 'user_id', 'product_id', 'id', 'id');
    }
}
