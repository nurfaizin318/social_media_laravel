<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id';


    protected $fillable = [
        'username',
        'email',
        'password',
        'bio',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function posts()
    {
        return $this->hasMany(Posts::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'user_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Likes::class, 'user_id', 'id');
    }

    public function friendshipsFrom()
    {
        return $this->hasMany(Friendships::class, 'from_id', 'id');
    }

    public function friendshipsTo()
    {
        return $this->hasMany(Friendships::class, 'to_id', 'id');
    }

    public function messagesSent()
    {
        return $this->hasMany(Messages::class, 'from_id', 'id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Messages::class, 'to_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'UserID', 'id');
    }

    /**
     * Get the identifier for JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->id;/// or return $this->id; if you use 'id' as primary key
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
