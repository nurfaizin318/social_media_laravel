<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendships extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dengan konvensi default
    protected $table = 'friendships';

    // Primary key jika berbeda dengan 'id'
    protected $primaryKey = 'friendship_id';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'user_id1',
        'user_id2',
        'status',
    ];

    // Relasi dengan model User untuk user_id1
    public function user1()
    {
        return $this->belongsTo(User::class, 'user_id1', 'id');
    }

    // Relasi dengan model User untuk user_id2
    public function user2()
    {
        return $this->belongsTo(User::class, 'user_id2', 'id');
    }
}