<?php

namespace App\Models\Users;
use App\Models\User;
use App\Models\Users\products;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'gender',
        'age',
        'address',
        'store_name',
        'phone',
        'business_permit',
        'valid_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
