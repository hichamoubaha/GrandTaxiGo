<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'profile_picture', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function tripHistory()
    {
        return $this->hasMany(TripHistory::class);
    }

    public function driverAvailability()
    {
        return $this->hasMany(DriverAvailability::class);
    }
}

