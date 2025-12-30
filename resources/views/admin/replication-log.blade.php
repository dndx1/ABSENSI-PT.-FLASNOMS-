<x-app-layout>
    <div class="py-8 sm:py-12 bg-gray-900 min-h-screen">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto space-y-6">

                <!-- Header -->
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-white mb-2">Log Replikasi Data</h1>
                    <p class="text-gray-400">Monitoring proses sinkronisasi data ke Server B dengan berbagai mode
                        konsistensi</p>
                </div>

                <!-- Info Cards - Statistik Replikasi -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <!-- Total Replikasi -->
                    <div class="bg-gray-800 border border-gray-700 shadow-lg rounded-xl p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Total Replikasi</p>
                                <p class="text-3xl font-bold text-white mt-2">{{ $logs->total() }}</p>
                            </div>
                            <div class="bg-blue-900/50 border border-blue-600 p-3 rounded-xl">
                                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Success -->
                    <div class="bg-gray-800 border border-gray-700 shadow-lg rounded-xl p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Success</p>
                                <p class="text-3xl font-bold text-white mt-2">
                                    {{ $logs->where('status', 'SUCCESS')->count() }}</p>
                            </div>
                            <div class="bg-green-900/50 border border-green-600 p-3 rounded-xl">
                                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Delay -->
                    <div class="bg-gray-800 border border-gray-700 shadow-lg rounded-xl p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Delay</p>
                                <p class="text-3xl font-bold text-white mt-2">{{ $logs->where('status', 'DELAY')->count() }}</p>
                            </div>
                            <div class="bg-yellow-900/50 border border-yellow-600 p-3 rounded-xl">
                                <svg class="w-8 h-8" style="color: #facc15;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pending -->
                    <div class="bg-gray-800 border border-gray-700 shadow-lg rounded-xl p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Pending</p>
                                <p class="text-3xl font-bold text-white mt-2">{{ $logs->where('status', 'PENDING')->count() }}</p>
                            </div>
                            <div class="bg-orange-900/50 border border-orange-600 p-3 rounded-xl">
                                <svg class="w-8 h-8" style="color: #fb923c;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Konsistensi -->
                <div class="bg-blue-900/30 border border-blue-600 rounded-lg p-4 mb-6"
                    style="background-color: rgba(30, 58, 138, 0.3);">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" style="color: #60a5fa;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm">
                            <p class="font-semibold mb-2" style="color: #93c5fd;">Mode Konsistensi:</p>
                            <ul class="space-y-2 text-xs">
                                <li class="flex items-start gap-2">
                                    <span class="inline-block w-2 h-2 rounded-full mt-1 flex-shrink-0"
                                        style="background-color: #4ade80;"></span>
                                    <span style="color: #d1d5db;">
                                        <strong style="color: #4ade80;">STRONG</strong> - Data langsung tersinkronisasi
                                        (10-100ms)
                                    </span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="inline-block w-2 h-2 rounded-full mt-1 flex-shrink-0"
                                        style="background-color: #facc15;"></span>
                                    <span style="color: #d1d5db;">
                                        <strong style="color: #facc15;">EVENTUAL</strong> - Data tersinkronisasi dengan
                                        delay (1-5 detik)
                                    </span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="inline-block w-2 h-2 rounded-full mt-1 flex-shrink-0"
                                        style="background-color: #fb923c;"></span>
                                    <span style="color: #d1d5db;">
                                        <strong style="color: #fb923c;">WEAK</strong> - Sinkronisasi tidak
                                        dijamin/pending
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                

                <!-- Table -->
                <div class="bg-gray-800 border border-gray-700 shadow-2xl rounded-xl overflow-hidden">
                    <div class="p-4 sm:p-6 border-b border-gray-700">
                        <h3 class="text-lg sm:text-xl font-semibold text-white">Tabel log </h3>
                        <p class="text-gray-400 text-xs sm:text-sm mt-1">Sekarang masih kosong. Minimal harus ada 3 baris data.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-900 border-b border-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-white">ID Absensi</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-white">Karyawan</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-white">Mode</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-white">Server Tujuan</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-white">Send Time</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-white">Receive Time</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-white">Latency</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-white">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse($logs as $log)
                                    <tr class="hover:bg-gray-700/30 transition-colors">
                                        <!-- ID Absensi -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-white text-sm">{{ $log->attendance_id }}</span>
                                        </td>

                                        <!-- Karyawan -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-white text-sm">{{ optional($log->attendance->user)->name ?? '-' }}</span>
                                        </td>

                                        <!-- Mode Konsistensi -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-white text-sm">{{ $log->consistency_mode }}</span>
                                        </td>

                                        <!-- Server Tujuan -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-white text-sm">{{ $log->target_server }}</span>
                                        </td>

                                        <!-- Send Time -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-white text-sm">{{ $log->send_time->format('H:i:s') }}</span>
                                        </td>

                                        <!-- Receive Time -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($log->receive_time)
                                                <span class="text-white text-sm">{{ $log->receive_time->format('H:i:s') }}</span>
                                            @else
                                                <span class="text-gray-500 text-sm">NULL</span>
                                            @endif
                                        </td>

                                        <!-- Latency -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($log->latency_ms)
                                                <span class="text-white text-sm">{{ $log->latency_ms < 1000 ? $log->latency_ms . 'ms' : ($log->latency_ms / 1000) . 's' }}</span>
                                            @else
                                                <span class="text-gray-500 text-sm">-</span>
                                            @endif
                                        </td>

                                        <!-- Status -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-white text-sm">{{ $log->status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                                <p class="text-gray-400 font-medium text-lg">Belum ada log replikasi</p>
                                                <p class="text-gray-500 text-sm mt-2">Log akan muncul ketika karyawan melakukan absensi</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($logs->hasPages())
                        <div class="px-6 py-4 bg-gray-900 border-t border-gray-700">
                            {{ $logs->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>