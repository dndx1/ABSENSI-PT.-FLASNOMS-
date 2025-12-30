<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplicationLog extends Model
{
    protected $fillable = [
        'attendance_id',
        'consistency_mode',
        'target_server',
        'send_time',
        'receive_time',
        'status',
        'latency_ms',
    ];

    protected $casts = [
        'send_time' => 'datetime',
        'receive_time' => 'datetime',
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}