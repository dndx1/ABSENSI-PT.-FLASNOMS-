<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::latest()->get();
        return view('attendance.index', compact('attendances'));
    }

    public function store(Request $request)
{
    $request->validate([
        'employee_name' => 'required',
        'client_time' => 'required'
    ]);

    Attendance::create([
        'employee_name' => $request->employee_name,
        'client_time' => Carbon::parse($request->client_time),
        'server_time' => Carbon::now()
    ]);

    return redirect()->back()->with('success', 'Absensi berhasil dicatat');
}

}
