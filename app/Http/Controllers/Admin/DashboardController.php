<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Default: tanggal hari ini jika tidak ada filter
        $startDate = $request->start_date 
            ? \Carbon\Carbon::parse($request->start_date)->startOfDay() 
            : now()->startOfDay();
        
        $endDate = $request->end_date 
            ? \Carbon\Carbon::parse($request->end_date)->endOfDay() 
            : now()->endOfDay();

        // Validasi: jika start_date > end_date, tukar
        if ($request->start_date && $request->end_date && $startDate > $endDate) {
            [$startDate, $endDate] = [$endDate, $startDate];
        }

        // Query absensi dengan filter berdasarkan CLIENT_TIME
        $query = Attendance::whereBetween('client_time', [$startDate, $endDate])
            ->with('user')
            ->whereNotNull('user_id')
            ->orderBy('client_time', 'desc');

        // Filter berdasarkan user_id (nama karyawan)
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter berdasarkan type (masuk/pulang)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Get data
        $attendances = $query->get(); // Atau ->paginate(20)

        // Ambil semua user untuk dropdown
        $users = User::orderBy('name')->get();

        return view('admin.dashboard', compact('attendances', 'users'));
    }
}