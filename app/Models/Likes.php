<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dengan konvensi default
    protected $table = 'likes';

    // Primary key jika berbeda dengan 'id'
    protected $primaryKey = 'like_id';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'post_id',
        'comment_id',
        'user_id',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi dengan model Post
    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id', 'id');
    }

    // Relasi dengan model Comment
    public function comment()
    {
        return $this->belongsTo(Comments::class, 'comment_id', 'id');
    }
}
