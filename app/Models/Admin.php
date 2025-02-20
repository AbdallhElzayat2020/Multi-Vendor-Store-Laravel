<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use  Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'username',
        'super_admin',
        'password',
        'phone_number',
        'remember_token',
    ];

    protected $table = 'admins';
}
