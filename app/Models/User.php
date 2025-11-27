<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // default
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'address',
        'role',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }
}
