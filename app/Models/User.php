<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Users\replies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto; // ✅ ADD THIS
use Laravel\Fortify\TwoFactorAuthenticatable;
use App\Models\Users\orders;
use App\Models\Users\products;
use App\Models\Profile;
use App\Models\Users\MarketMonitoring;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;
    use HasApiTokens, HasFactory, Notifiable, HasProfilePhoto;

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
    ];

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? asset('storage/' . $this->profile_photo_path)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=0D8ABC&color=fff';
    }

    /**
     * The attributes that should be appended to JSON.
     */
    protected $appends = [
        'profile_photo_url', // ✅ REQUIRED for Breeze photo display
    ];

    // Relationships
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
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
        return $this->hasMany(orders::class);
    }

    public function products()
    {
        return $this->hasMany(products::class, 'user_id');
    }

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    public function reviewReplies()
    {
        return $this->hasMany(replies::class);
    }

    public function ordersPlaced()
    {
        return $this->hasMany(orders::class, 'user_id');
    }

    public function ordersReceived()
    {
        return $this->hasMany(orders::class, 'seller_id');
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
        return $this->hasManyThrough(MarketMonitoring::class, products::class, 'user_id', 'product_id', 'id', 'id');
    }
}