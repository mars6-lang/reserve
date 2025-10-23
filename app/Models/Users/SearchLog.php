<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'keyword',
        'user_id',
    ];

    // optional: relation to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
