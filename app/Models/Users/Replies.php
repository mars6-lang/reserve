<?php

namespace App\Models\Users;
use App\Models\User;
use App\Models\Users\reviewcomments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    use HasFactory;

    protected $fillable = ['review_id', 'user_id', 'reply'];

    public function review()
    {
        return $this->belongsTo(reviewcomments::class, 'review_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
