<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Absensi - PT. FLASHNOMS</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 font-sans antialiased">
    
    <!-- Navigation -->
    @if (Route::has('login'))
    <nav class="w-full bg-gray-800 shadow-lg border-b border-gray-700">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/50">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-lg font-semibold text-white">PT. FLASHNOMS</span>
            </div>
            {{-- <div class="space-x-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-5 py-2 rounded-lg hover:from-blue-500 hover:to-blue-600 font-medium shadow-lg shadow-blue-500/30 transition-all">Dashboard</a>
                @else
                   
                @endauth
            </div> --}}
        </div>
    </nav>
    @endif

    <!-- Main Content -->
    <section class="py-16 px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-white mb-3">
                    Sistem Absensi Karyawan
                </h1>
                <p class="text-lg text-gray-400">
                    PT. FLASHNOMS
                </p>
            </div>

            <!-- Login Card -->
            <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-2xl p-8 max-w-md mx-auto mb-12">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-blue-900 border border-blue-700 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-500/30">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-white mb-2">Akses Karyawan</h2>
                    <p class="text-gray-400 text-sm">Silakan masuk untuk melakukan absensi</p>
                </div>
                <a href="{{ route('login') }}" class="block w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white text-center px-6 py-3 rounded-lg hover:from-blue-500 hover:to-blue-600 font-medium shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-1">
                    Masuk ke Sistem
                </a>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-6 mb-12">
                <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg shadow-lg hover:shadow-xl hover:border-blue-500 transition-all duration-300">
                    <div class="w-12 h-12 bg-blue-900 border border-blue-700 rounded-lg flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-white mb-2">Absensi Real-time</h3>
                    <p class="text-gray-400 text-sm">Check-in dan check-out tercatat otomatis</p>
                </div>

                <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg shadow-lg hover:shadow-xl hover:border-green-500 transition-all duration-300">
                    <div class="w-12 h-12 bg-green-900 border border-green-700 rounded-lg flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-white mb-2">Tracking Lokasi</h3>
                    <p class="text-gray-400 text-sm">Validasi lokasi dengan GPS</p>
                </div>

                <div class="bg-gray-800 border border-gray-700 p-6 rounded-lg shadow-lg hover:shadow-xl hover:border-purple-500 transition-all duration-300">
                    <div class="w-12 h-12 bg-purple-900 border border-purple-700 rounded-lg flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-white mb-2">Laporan Kehadiran</h3>
                    <p class="text-gray-400 text-sm">Rekap absensi harian dan bulanan</p>
                </div>
            </div>

            <!-- Info -->
            <div class="bg-blue-900 border border-blue-700 rounded-lg p-6 text-center shadow-lg">
                <p class="text-gray-200">
                    <span class="font-semibold text-white">Butuh bantuan?</span> Hubungi bagian HR atau IT Support <span class="text-blue-400 font-medium">08821608965</span>
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-950 border-t border-gray-800 text-gray-400 py-8 px-6 mt-12">
        <div class="max-w-6xl mx-auto text-center">
            <p class="text-sm">&copy; 2024 PT. FLASHNOMS - Sistem Absensi Karyawan</p>
            <p class="text-xs mt-2 text-gray-500">Laravel v{{ Illuminate\Foundation\Application::VERSION }}</p>
        </div>
    </footer>

</body>
</html>