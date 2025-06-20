<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketAnalysis extends Model
{
    use HasFactory;
    protected $fillable = ['fish_type', 'price_per_kg', 'location', 'date'];
}
