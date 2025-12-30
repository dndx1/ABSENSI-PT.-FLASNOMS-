<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Dashboard Admin – Laporan Absensi
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12 bg-gray-900 min-h-screen">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto space-y-6">


                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6">
                    <!-- Total Absensi Hari Ini -->
                    <div
                        class="bg-gray-800 border border-gray-700 shadow-lg rounded-xl hover:shadow-xl hover:border-blue-500 transition-all duration-300 p-6">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Total Absensi Hari Ini</p>
                                <p class="text-3xl font-bold text-white mt-2">{{ $attendances->count() }}</p>
                            </div>
                            <div class="bg-blue-900/50 border border-blue-600 p-3 rounded-xl">
                                <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Absen Masuk -->
                    <div
                        class="bg-gray-800 border border-gray-700 shadow-lg rounded-xl hover:shadow-xl hover:border-green-500 transition-all duration-300 p-6">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Absen Masuk</p>
                                <p class="text-3xl font-bold text-white mt-2">
                                    {{ $attendances->where('type', 'masuk')->count() }}
                                </p>
                            </div>
                            <div class="bg-green-900/50 border border-green-600 p-3 rounded-xl">
                                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Absen pulang -->
                    <div
                        class="bg-gray-800 border border-gray-700 shadow-lg rounded-xl hover:shadow-xl hover:border-purple-500 transition-all duration-300 p-6">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Absen Pulang</p>
                                <p class="text-3xl font-bold text-white mt-2">
                                    {{ $attendances->where('type', 'pulang')->count() }}
                                </p>
                            </div>
                            <div class="bg-green-900/50 border border-green-600 p-3 rounded-xl">
                                <svg class="w-8 h-8" style="color: #ef4444;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Form -->
                <div class="bg-gray-800 border border-gray-700 shadow-lg rounded-xl p-4 mb-6">
                    <h4 class="text-white text-sm font-medium mb-4">Filter Data Absensi</h4>
                    <form method="GET" action="{{ url()->current() }}" class="flex flex-wrap gap-4 items-end">

                        <!-- Filter Nama Karyawan -->
                        <div class="flex-1 min-w-0">
                            <label for="user_id" class="block text-sm font-medium text-gray-400 mb-1">Nama
                                Karyawan</label>
                            <select name="user_id" id="user_id"
                                class="w-full bg-white border border-gray-300 text-gray-900 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Semua Karyawan</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-1 min-w-0">
                            <label for="start_date" class="block text-sm font-medium text-gray-400 mb-1">Tanggal
                                Mulai</label>
                            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                                class="w-full bg-white border border-gray-300 text-gray-900 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                        <div class="flex-1 min-w-0">
                            <label for="end_date" class="block text-sm font-medium text-gray-400 mb-1">Tanggal
                                Akhir</label>
                            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                                class="w-full bg-white border border-gray-300 text-gray-900 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                        <div class="flex-1 min-w-0">
                            <label for="type" class="block text-sm font-medium text-gray-400 mb-1">Kategori
                                Absensi</label>
                            <select name="type" id="type"
                                class="w-full bg-white border border-gray-300 text-gray-900 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="">Semua</option>
                                <option value="masuk" {{ request('type') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                <option value="pulang" {{ request('type') == 'pulang' ? 'selected' : '' }}>Pulang</option>
                            </select>
                        </div>
                        <div class="flex-shrink-0">
                            <label for="end_date" class="block text-sm font-medium text-transparan mb-1">-</label>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200 font-medium h-[42px]">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Table -->
                <div class="bg-gray-800 border border-gray-700 shadow-2xl rounded-xl overflow-hidden w-full">
                    <div class="p-4 sm:p-6 bg-gradient-to-r from-blue-900 to-blue-800 border-b border-gray-700">
                        <h3 class="text-lg sm:text-xl font-semibold text-white">Data Absensi Karyawan</h3>
                        <p class="text-white text-xs sm:text-sm mt-1">Daftar lengkap kehadiran karyawan</p>
                    </div>

                    <div class="overflow-x-auto w-full">
                        <table class="w-full min-w-max">
                            <thead>
                                <tr class="bg-gray-900 border-b border-gray-700">
                                    <th
                                        class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-blue-400 uppercase tracking-wider whitespace-nowrap">
                                        Nama</th>
                                    <th
                                        class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-blue-400 uppercase tracking-wider whitespace-nowrap">
                                        Jenis</th>
                                    <th
                                        class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-blue-400 uppercase tracking-wider whitespace-nowrap">
                                        Status</th>
                                    <th
                                        class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-blue-400 uppercase tracking-wider whitespace-nowrap">
                                        Client Time</th>
                                    <th
                                        class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-blue-400 uppercase tracking-wider whitespace-nowrap">
                                        Server Time</th>
                                    <th
                                        class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-blue-400 uppercase tracking-wider whitespace-nowrap">
                                        Disimpan (DB)</th>
                                    <th
                                        class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-blue-400 uppercase tracking-wider whitespace-nowrap">
                                        Lokasi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse($attendances as $a)
                                    <tr class="hover:bg-gray-700/50 transition-colors">
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-full flex items-center justify-center mr-2 sm:mr-3 flex-shrink-0">
                                                    <span
                                                        class="text-white font-bold text-xs sm:text-sm">{{ substr(optional($a->user)->name ?? 'N', 0, 1) }}</span>
                                                </div>
                                                <span
                                                    class="text-white font-medium text-sm sm:text-base">{{ optional($a->user)->name ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                            @if($a->type === 'masuk')
                                                <span
                                                    class="px-3 py-1 sm:px-4 sm:py-1.5 inline-flex text-xs sm:text-sm font-semibold rounded-lg text-white whitespace-nowrap"
                                                    style="background-color: #16a34a;">
                                                    Masuk
                                                </span>
                                            @else
                                                <span
                                                    class="px-3 py-1 sm:px-4 sm:py-1.5 inline-flex text-xs sm:text-sm font-semibold rounded-lg text-white whitespace-nowrap"
                                                    style="background-color: #dc2626;">
                                                    Pulang
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                            @php
                                                $statusColors = [
                                                    'tepat_waktu' => '#16a34a',        // hijau
                                                    'terlambat' => '#eab308',          // kuning
                                                    'sangat_terlambat' => '#f97316',   // orange
                                                    'lembur' => '#06b6d4',             // cyan/biru muda
                                                    'izin' => '#3b82f6',               // biru
                                                    'sakit' => '#8b5cf6'               // ungu
                                                ];
                                                $statusLabels = [
                                                    'tepat_waktu' => 'Tepat Waktu',
                                                    'terlambat' => 'Terlambat',
                                                    'sangat_terlambat' => 'Sangat Terlambat',
                                                    'lembur' => 'Lembur',
                                                    'izin' => 'Izin',
                                                    'sakit' => 'Sakit'
                                                ];
                                                $statusColor = $statusColors[$a->status ?? 'tepat_waktu'] ?? '#6b7280';
                                                $statusLabel = $statusLabels[$a->status ?? 'tepat_waktu'] ?? 'Tidak Diketahui';
                                            @endphp
                                            <span
                                                class="px-3 py-1 sm:px-4 sm:py-1.5 inline-flex text-xs sm:text-sm font-semibold rounded-lg text-white whitespace-nowrap"
                                                style="background-color: {{ $statusColor }};">
                                                {{ $statusLabel }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-white text-xs sm:text-sm font-medium">
                                            {{ \Carbon\Carbon::parse($a->client_time)->format('d/m/Y H:i:s') }}
                                        </td>
                                        <td
                                            class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-white text-xs sm:text-sm font-medium">
                                            {{ \Carbon\Carbon::parse($a->server_time)->format('d/m/Y H:i:s') }}
                                        </td>
                                        <td
                                            class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-white text-xs sm:text-sm font-medium">
                                            {{ $a->created_at->format('d/m/Y H:i:s') }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 sm:py-4">
                                            <div class="flex items-start gap-2">
                                                @if($a->latitude && $a->longitude)
                                                    <svg class="w-4 h-4 text-green-400 flex-shrink-0 mt-0.5" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    <div class="text-xs sm:text-sm">
                                                        <p class="text-white font-medium">
                                                            {{ $a->location_address ?? 'Alamat tidak tersedia' }}</p>
                                                        <p class="text-gray-400 mt-0.5">
                                                            <span class="font-mono">{{ number_format($a->latitude, 6) }},
                                                                {{ number_format($a->longitude, 6) }}</span>
                                                        </p>
                                                        <a href="https://www.google.com/maps?q={{ $a->latitude }},{{ $a->longitude }}"
                                                            target="_blank"
                                                            class="text-blue-400 hover:text-blue-300 inline-flex items-center gap-1 mt-1">
                                                            Lihat di Maps
                                                        </a>
                                                    </div>
                                                @else
                                                    <svg class="w-4 h-4 text-red-400 flex-shrink-0 mt-0.5" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                    </svg>
                                                    <span class="text-gray-500 text-xs sm:text-sm">Lokasi tidak tersedia</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div
                                                    class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                    </svg>
                                                </div>
                                                <p class="text-gray-400 font-medium">Belum ada data absensi</p>
                                                <p class="text-gray-500 text-sm mt-1">Data akan muncul ketika karyawan
                                                    melakukan absensi</p>
                                            </div>
                                        </td>

                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination (if needed) -->
                    @if(method_exists($attendances, 'hasPages') && $attendances->hasPages())
                        <div class="px-6 py-4 bg-gray-900 border-t border-gray-700">
                            {{ $attendances->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>