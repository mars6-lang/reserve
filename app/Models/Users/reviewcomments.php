<?php

namespace App\Models\Users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reviewcomments extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'rating', 'comment','photo'];

    public function product()
    {
        return $this->belongsTo(products::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(replies::class, 'review_id'); // Explicit foreign key
    }

}
