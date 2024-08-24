<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'type',
        'reference_id',
        'time_stamp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function like()
    {
        return $this->belongsTo(Likes::class, 'reference_id', 'id');
    }

    public function comment()
    {
        return $this->belongsTo(Comments::class, 'reference_id', 'id');
    }

    public function friendship()
    {
        return $this->belongsTo(Friendships::class, 'reference_id', 'id');
    }
}