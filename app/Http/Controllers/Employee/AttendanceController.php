<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:masuk,pulang',
            'client_time' => 'required',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'location_address' => 'nullable|string|max:255',
        ]);

        $today = Carbon::today();
        $now = now();

        // CEK: Sudah absen hari ini belum?
        $alreadyExists = Attendance::where('user_id', auth()->id())
            ->where('type', $request->type)
            ->whereDate('server_time', $today)
            ->exists();

        if ($alreadyExists) {
            return back()->with('error', 'Anda sudah absen ' . $request->type . ' hari ini!');
        }

        // Setup batas waktu
        $batasWaktu = Carbon::today()->setTime(8, 0, 0); // Jam 08:00 (batas tepat waktu)
        $batasMaksimal = Carbon::today()->setTime(9, 0, 0); // Jam 09:00 (batas maksimal)

        // Tentukan status
        $status = 'tepat_waktu';
        $keterangan = null;

        if ($request->type === 'masuk') {
            if ($now->gt($batasMaksimal)) {
                // Lewat jam 9 = sangat terlambat
                $status = 'sangat_terlambat';
                $keterangan = 'Absen masuk setelah jam 09:00';
            } elseif ($now->gt($batasWaktu)) {
                // Lewat jam 8 tapi sebelum jam 9 = terlambat
                $status = 'terlambat';
                $keterangan = 'Absen masuk setelah jam 08:00';
            }
        } elseif ($request->type === 'pulang') {
            // Jam pulang tepat waktu = jam 16:00 (4 sore)
            $jamPulangNormal = Carbon::parse($now->format('Y-m-d') . ' 16:00:00');
            
            if ($now->gt($jamPulangNormal)) {
                // Pulang setelah jam 4 = lembur
                $status = 'lembur';
                $keterangan = 'Pulang setelah jam 16:00 (Lembur)';
            } else {
                // Pulang sebelum atau tepat jam 4 = tepat waktu
                $status = 'tepat_waktu';
                $keterangan = 'Pulang tepat waktu';
            }
        }

        // SIMPAN ABSENSI
        $attendance = Attendance::create([
            'user_id'          => auth()->id(),
            'type'             => $request->type,
            'status'           => $status,
            'keterangan'       => $keterangan,
            'client_time'      => Carbon::parse($request->client_time),
            'server_time'      => $now,
            'latitude'         => $request->latitude,
            'longitude'        => $request->longitude,
            'location_address' => $request->location_address,
        ]);

        // SIMULASI REPLIKASI KE SERVER B
        $this->simulateReplication($attendance);

        // Pesan sesuai status
        if ($status === 'sangat_terlambat') {
            return back()->with('warning', '⚠️ Absensi tercatat, namun Anda sangat terlambat! (Lewat jam 09:00).');
        }

        if ($status === 'terlambat') {
            return back()->with('warning', '⚠️ Absensi masuk berhasil, tapi Anda terlambat! (Batas: 08:00)');
        }

        if ($status === 'lembur') {
            return back()->with('success', '✅ Absensi pulang tercatat. Anda lembur setelah jam 16:00!');
        }

        return back()->with('success', '✅ Absensi ' . $request->type . ' berhasil disimpan!');
    }

    private function simulateReplication($attendance)
    {
        // Simulasi 3 mode konsistensi secara random
        $modes = ['STRONG', 'EVENTUAL', 'WEAK'];
        $mode = $modes[array_rand($modes)];
        
        $sendTime = now();
        $receiveTime = null;
        $status = 'PENDING';
        $latency = null;
        
        // Simulasi delay berdasarkan mode
        if ($mode === 'STRONG') {
            // STRONG: instant (10-100ms)
            $latency = rand(10, 100);
            $receiveTime = $sendTime->copy()->addMilliseconds($latency);
            $status = 'SUCCESS';
        } elseif ($mode === 'EVENTUAL') {
            // EVENTUAL: delay 1-5 detik
            $latency = rand(1000, 5000);
            $receiveTime = $sendTime->copy()->addMilliseconds($latency);
            $status = 'DELAY';
        } else {
            // WEAK: belum diterima / pending
            $status = 'PENDING';
        }
        
        \App\Models\ReplicationLog::create([
            'attendance_id' => $attendance->id,
            'consistency_mode' => $mode,
            'target_server' => 'Server B',
            'send_time' => $sendTime,
            'receive_time' => $receiveTime,
            'status' => $status,
            'latency_ms' => $latency,
        ]);
    }
}