<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model implements AuthenticatableContract
{
    use HasFactory, HasApiTokens, Notifiable, Authenticatable;

    protected $table = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'language'
    ];

    protected $hidden = [
        'password'
    ];
}
