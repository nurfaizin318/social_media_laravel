<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dengan konvensi default
    protected $table = 'posts';

    // Primary key jika berbeda dengan 'id'
    protected $primaryKey = 'post_id';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'user_id',
        'content',  
        'media_type',
        'media_url',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'post_id');
    }

    // Relasi dengan model Comment
    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id', 'post_id');
    }
}