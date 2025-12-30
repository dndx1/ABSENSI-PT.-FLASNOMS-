<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'status', // TAMBAHKAN INI
        'client_time',
        'server_time',
        'latitude',
        'longitude',
        'location_address',
    ];

    protected $casts = [
        'client_time' => 'datetime',
        'server_time' => 'datetime',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}