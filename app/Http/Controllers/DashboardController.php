<?php

namespace App\Http\Controllers;

use App\Models\Attendance;

class DashboardController extends Controller
{
    public function employee()
    {
        $attendances = Attendance::where('user_id', auth()->id())
            ->latest()
            ->paginate(15); // Ubah dari get() jadi paginate()
        return view('dashboard.employee', compact('attendances'));
    }

    public function admin()
    {
        $attendances = Attendance::with('user') // Eager load user
            ->latest()
            ->paginate(20); // Ubah dari get() jadi paginate()
        return view('dashboard.admin', compact('attendances'));
    }
}