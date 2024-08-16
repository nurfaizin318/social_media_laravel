<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dengan konvensi default
    protected $table = 'notifications';

    // Primary key jika berbeda dengan 'id'
    protected $primaryKey = 'notification_id';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'user_id',
        'type',
        'reference_id',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}