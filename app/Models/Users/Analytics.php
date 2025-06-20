<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;
     protected $fillable = [
        'fish_type',
        'quantity',
        'location',
        'caught_on',
        'image',
        'user_id'
    ];
}
