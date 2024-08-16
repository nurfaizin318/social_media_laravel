<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Messages extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dengan konvensi default
    protected $table = 'messages';

    // Primary key jika berbeda dengan 'id'
    protected $primaryKey = 'message_id';

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'chat_room',
    ];

    // Relasi dengan model User untuk pengirim
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    // Relasi dengan model User untuk penerima
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}