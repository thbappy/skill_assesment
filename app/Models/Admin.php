<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    use HasFactory;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password','gauth_id',
        'gauth_type'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
