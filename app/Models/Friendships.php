<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendships extends Model
{
    use HasFactory;

    protected $table = 'friendships';

    protected $fillable = [
        'from_id',
        'to_id',
        'status',
        'time_stamp',
    ];

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'from_id', 'id');
    }

    public function userTo()
    {
        return $this->belongsTo(User::class, 'to_id', 'id');
    }
}