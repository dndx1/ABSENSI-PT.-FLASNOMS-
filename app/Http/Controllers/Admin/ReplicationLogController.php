<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReplicationLog;
use Illuminate\Http\Request;

class ReplicationLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ReplicationLog::with('attendance.user')
            ->latest('send_time')
            ->paginate(20);
            
        return view('admin.replication-log', compact('logs'));
    }
}