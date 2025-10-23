<?php

namespace App\Models\Users;

use App\Models\User;
use App\Models\Users\reviewcomments;
use App\Models\Users\orders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'image',
        'category',
        'discount_percent',
    ];

    // seller (user who owns product)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // New arrival logic
    public function isNewArrival()
    {
        return $this->created_at >= now()->subDays(7) && $this->discount_percent == 0;
    }

    // Discount logic
    public function isDiscounted()
    {
        return $this->discount_percent > 0;
    }

    // reviews
    public function reviews()
    {
        return $this->hasMany(reviewcomments::class, 'product_id');
    }

    // orders
    public function orders()
    {
        return $this->hasMany(orders::class, 'product_id');
    }

    // monitoring logs
    public function marketLogs()
    {
        return $this->hasMany(MarketMonitoring::class, 'product_id');
    }
}
