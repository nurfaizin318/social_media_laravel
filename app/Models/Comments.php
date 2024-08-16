<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dengan konvensi default
    protected $table = 'comments';

    // Primary key jika berbeda dengan 'id'
    protected $primaryKey = 'comment_id';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'post_id',
        'user_id',
        'content',
    ];

    // Relasi dengan model Post
    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id', 'post_id');
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}