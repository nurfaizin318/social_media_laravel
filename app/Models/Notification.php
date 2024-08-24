<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'UserID',
        'Type',
        'ReferenceID',
        'time_stamp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'id');
    }

    public function like()
    {
        return $this->belongsTo(Likes::class, 'ReferenceID', 'id');
    }

    public function comment()
    {
        return $this->belongsTo(Comments::class, 'ReferenceID', 'id');
    }

    public function friendship()
    {
        return $this->belongsTo(Friendships::class, 'ReferenceID', 'id');
    }
}