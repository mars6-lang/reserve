<?php

namespace App\Models\Users;
use App\Models\User;
use App\Models\Users\reviewcomments;
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

    public function user()
    {
        return $this->belongsTo(User::class); // seller
    }

    public function reviews()
    {
        return $this->hasMany(reviewcomments::class, 'product_id');
    }

    public function orders()
    {
        return $this->hasMany(orders::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Users\products::class);
    }

    public function marketLogs()
    {
        return $this->hasMany(MarketMonitoring::class, 'product_id');
    }

}
