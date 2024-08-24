<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $table = 'likes';

    protected $fillable = [
        'post_id',
        'comment_id',
        'user_id',
        'time_stamp',
    ];

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id', 'id');
    }

    public function comment()
    {
        return $this->belongsTo(Comments::class, 'comment_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}