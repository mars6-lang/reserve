<?php

namespace App\Models\Users;
use App\Models\User;
use App\Models\Users\products;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class orders extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'seller_id',
        'quantity',
        'custom_price',
        'total_price',
        'payment_method',
    ];



    // Buyer
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Seller
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // Product
    public function product()
    {
        return $this->belongsTo(products::class, 'product_id');
    }

    // marketMonitoring
    public function marketMonitoring()
    {
        return $this->hasOne(MarketMonitoring::class, 'order_id');
    }

    public function cancel()
    {
        if ($this->status !== 'cancelled') {
            $this->status = 'cancelled';
            $this->save();
        }
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function isActive()
    {
        return $this->status === 'active';
    }



}
