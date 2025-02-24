<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id', 'location', 'available_from', 'available_until', 'is_available'
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
