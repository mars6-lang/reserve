<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users\products;


class MarketMonitoring extends Model
{
    use HasFactory;

    protected $table = 'market_monitoring';


    protected $fillable = ['product_id', 'price', 'quantity', 'market_date', 'custom_price'];

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id');
    }

    public function seller()
    {
        return $this->product ? $this->product->user() : null; // Optional shortcut
    }

    public function finalPrice()
    {
        return $this->custom_price > 0 ? $this->custom_price : $this->price;
    }

    public function order()
    {
        return $this->belongsTo(orders::class, 'order_id');
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
