<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;


    /**
     *User status
     */
    public const NO_ACTIVE = 'No Active';
    public const BANNED = 'Banned';
    public const ACTIVE = 'Active';

    /**
     *User roles
     */
    public const USER = 'User';
    public const MODERATOR = 'Moderator';
    public const ADMIN = 'Admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'telephone',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ads() {
        return $this->hasMany(Ad::class);
    }

    public function moderation() {
        return $this->hasMany(Moderation::class);
    }
}
