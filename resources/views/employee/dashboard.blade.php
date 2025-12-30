<x-app-layout>
    <div class="py-8 sm:py-12 bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="text-gray-400">Dashboard Absensi Karyawan PT. FLASHNOMS</p>
            </div>

          <!-- Success Message -->
@if(session('success'))
    <div id="success-alert" class="mb-6 px-4 py-3 rounded-lg flex items-center justify-between gap-3" style="background-color: rgba(5, 46, 22, 0.8); border: 1px solid #16a34a; color: #86efac;">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span style="color: #86efac;">{{ session('success') }}</span>
        </div>
        <button onclick="document.getElementById('success-alert').remove()" style="color: #86efac;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#86efac'">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
@endif

<!-- Error Message -->
@if(session('error'))
    <div id="error-alert" class="mb-6 px-4 py-3 rounded-lg flex items-center justify-between gap-3" style="background-color: rgba(127, 29, 29, 0.8); border: 1px solid #ef4444; color: #fca5a5;">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span style="color: #fca5a5;">{{ session('error') }}</span>
        </div>
        <button onclick="document.getElementById('error-alert').remove()" style="color: #fca5a5;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#fca5a5'">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
@endif


<!-- Warning Message (Terlambat) -->
@if(session('warning'))
    <div id="warning-alert" class="mb-6 px-4 py-3 rounded-lg flex items-center justify-between gap-3" style="background-color: rgba(133, 77, 14, 0.8); border: 1px solid #f59e0b; color: #fcd34d;">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <span style="color: #fcd34d;">{{ session('warning') }}</span>
        </div>
        <button onclick="document.getElementById('warning-alert').remove()" style="color: #fcd34d;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#fcd34d'">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
@endif

            <!-- Current Date & Time -->
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Tanggal & Waktu Sekarang</p>
                        <p class="text-white text-2xl font-bold" id="current-datetime">
                            {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}
                        </p>
                        <p class="text-blue-400 text-xl font-semibold mt-1" id="current-time">
                            {{ \Carbon\Carbon::now()->format('H:i:s') }}
                        </p>
                    </div>
                    <div class="w-16 h-16 bg-blue-900/50 border border-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Attendance Form -->
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-8 shadow-2xl">
                <h2 class="text-xl font-bold text-white mb-6">Absensi Hari Ini</h2>
                
                <!-- Location Status -->
                <div id="location-status" class="mb-6 p-4 rounded-lg border" style="background-color: rgba(59, 130, 246, 0.1); border-color: #3b82f6; display: none;">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" style="color: #60a5fa;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <p style="color: #93c5fd;" class="text-sm font-medium">Lokasi Terdeteksi</p>
                            <p id="location-text" style="color: #dbeafe;" class="text-xs">Mengambil lokasi...</p>
                        </div>
                    </div>
                </div>

                <div id="location-error" class="mb-6 p-4 rounded-lg border" style="background-color: rgba(239, 68, 68, 0.1); border-color: #ef4444; display: none;">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" style="color: #f87171;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p style="color: #fca5a5;" class="text-sm font-medium">Lokasi Tidak Tersedia</p>
                            <p style="color: #fecaca;" class="text-xs">Aktifkan GPS untuk melakukan absensi</p>
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('attendance.store') }}" id="attendance-form">
                    @csrf
                    <input type="hidden" name="client_time" id="client_time">
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <input type="hidden" name="location_address" id="location_address">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Absen Masuk -->
                        <button type="submit" name="type" value="masuk" id="btn-masuk" disabled
                            class="group relative bg-gradient-to-br from-green-600 to-green-700 hover:from-green-500 hover:to-green-600 text-white p-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-green-500/50 border border-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xl font-bold">Absen Masuk</p>
                                    <p class="text-sm text-green-100 mt-1">Check-in kehadiran</p>
                                </div>
                            </div>
                        </button>

                        <!-- Absen Pulang -->
                        <button type="submit" name="type" value="pulang" id="btn-pulang" disabled
                            class="group relative bg-gradient-to-br from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white p-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-red-500/50 border border-red-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xl font-bold">Absen Pulang</p>
                                    <p class="text-sm text-red-100 mt-1">Check-out kehadiran</p>
                                </div>
                            </div>
                        </button>
                    </div>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-700">
                    <p class="text-gray-400 text-sm text-center">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Lokasi GPS akan direkam untuk verifikasi absensi
                    </p>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-900/50 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Status</p>
                            <p class="text-white font-semibold">Aktif</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-900/50 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Lokasi GPS</p>
                            <p id="location-display" class="text-white font-semibold text-sm">Mendeteksi...</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-900/50 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Divisi</p>
                            <p class="text-white font-semibold">Karyawan</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
    // Variables to store location
    let currentLatitude = null;
    let currentLongitude = null;
    let locationReady = false;

    // Get Location on page load
    function getLocation() {
        console.log('Mencoba mendapatkan lokasi...');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    console.log('✅ Lokasi berhasil didapat');
                    currentLatitude = position.coords.latitude;
                    currentLongitude = position.coords.longitude;
                    console.log('Lat:', currentLatitude, 'Lng:', currentLongitude);
                    
                    // Update hidden inputs
                    document.getElementById('latitude').value = currentLatitude;
                    document.getElementById('longitude').value = currentLongitude;
                    
                    // Get address from coordinates
                    getAddressFromCoordinates(currentLatitude, currentLongitude);
                    
                    // Enable buttons
                    document.getElementById('btn-masuk').disabled = false;
                    document.getElementById('btn-pulang').disabled = false;
                    locationReady = true;
                    
                    // Show success status
                    document.getElementById('location-status').style.display = 'block';
                    document.getElementById('location-error').style.display = 'none';
                },
                function(error) {
                    console.error('❌ Error getting location:', error);
                    document.getElementById('location-error').style.display = 'block';
                    document.getElementById('location-status').style.display = 'none';
                    document.getElementById('location-display').textContent = 'GPS Tidak Aktif';
                    document.getElementById('location-display').style.color = '#f87171';
                }
            );
        } else {
            console.error('❌ Browser tidak support geolocation');
            alert('Browser Anda tidak mendukung Geolocation');
            document.getElementById('location-display').textContent = 'Tidak Didukung';
            document.getElementById('location-display').style.color = '#f87171';
        }
    }

    // Get address from coordinates using reverse geocoding
    function getAddressFromCoordinates(lat, lng) {
        const coords = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        console.log('Mengambil alamat untuk:', coords);
        
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
            .then(response => response.json())
            .then(data => {
                console.log('Data alamat:', data);
                let address = 'Lokasi Terdeteksi';
                
                if (data.address) {
                    const parts = [];
                    if (data.address.road) parts.push(data.address.road);
                    if (data.address.suburb) parts.push(data.address.suburb);
                    if (data.address.city) parts.push(data.address.city);
                    
                    address = parts.length > 0 ? parts.join(', ') : data.display_name;
                    
                    if (address.length > 40) {
                        address = address.substring(0, 37) + '...';
                    }
                }
                
                document.getElementById('location-display').textContent = address;
                document.getElementById('location-text').textContent = `${address} (${coords})`;
                document.getElementById('location_address').value = address;
                console.log('✅ Alamat berhasil diset:', address);
            })
            .catch(error => {
                console.error('Error getting address:', error);
                document.getElementById('location-display').textContent = coords;
                document.getElementById('location-text').textContent = `Koordinat: ${coords}`;
                document.getElementById('location_address').value = coords;
            });
    }

    // Set client time in MySQL datetime format (Asia/Jakarta timezone)
    function updateClientTime() {
        const now = new Date();
        
        // Convert to Asia/Jakarta timezone
        const jakartaTime = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
        
        // Format: YYYY-MM-DD HH:MM:SS
        const mysqlFormat = jakartaTime.getFullYear() + '-' +
            String(jakartaTime.getMonth() + 1).padStart(2, '0') + '-' +
            String(jakartaTime.getDate()).padStart(2, '0') + ' ' +
            String(jakartaTime.getHours()).padStart(2, '0') + ':' +
            String(jakartaTime.getMinutes()).padStart(2, '0') + ':' +
            String(jakartaTime.getSeconds()).padStart(2, '0');
        
        document.getElementById('client_time').value = mysqlFormat;
        console.log('Client time set to:', mysqlFormat);
    }
    
//     // Get Location on page load with HIGH ACCURACY
// function getLocation() {
//     console.log('Mencoba mendapatkan lokasi dengan high accuracy...');
//     if (navigator.geolocation) {
//         // Opsi untuk high accuracy GPS
//         const options = {
//             enableHighAccuracy: true,  // Paksa pakai GPS hardware
//             timeout: 15000,            // Timeout 15 detik
//             maximumAge: 0              // Jangan pakai cache lokasi lama
//         };
        
//         // Tampilkan loading state
//         document.getElementById('location-text').textContent = 'Mengaktifkan GPS... (tunggu 5-10 detik)';
        
//         navigator.geolocation.getCurrentPosition(
//             function(position) {
//                 console.log('✅ Lokasi berhasil didapat');
//                 console.log('Akurasi: ±' + position.coords.accuracy + ' meter');
                
//                 currentLatitude = position.coords.latitude;
//                 currentLongitude = position.coords.longitude;
//                 console.log('Lat:', currentLatitude, 'Lng:', currentLongitude);
                
//                 // Cek akurasi GPS
//                 const accuracy = position.coords.accuracy;
//                 let accuracyStatus = '';
//                 let accuracyColor = '';
                
//                 if (accuracy <= 50) {
//                     accuracyStatus = '✅ GPS Sangat Akurat';
//                     accuracyColor = '#16a34a'; // hijau
//                 } else if (accuracy <= 100) {
//                     accuracyStatus = '⚠️ GPS Cukup Akurat';
//                     accuracyColor = '#eab308'; // kuning
//                 } else if (accuracy <= 500) {
//                     accuracyStatus = '⚠️ GPS Kurang Akurat';
//                     accuracyColor = '#f59e0b'; // orange
//                 } else {
//                     accuracyStatus = '❌ GPS Tidak Akurat';
//                     accuracyColor = '#ef4444'; // merah
//                 }
                
//                 console.log('Status Akurasi:', accuracyStatus, '(±' + Math.round(accuracy) + 'm)');
                
//                 // Update hidden inputs
//                 document.getElementById('latitude').value = currentLatitude;
//                 document.getElementById('longitude').value = currentLongitude;
                
//                 // Get address from coordinates
//                 getAddressFromCoordinates(currentLatitude, currentLongitude, accuracy, accuracyStatus);
                
//                 // Enable buttons
//                 document.getElementById('btn-masuk').disabled = false;
//                 document.getElementById('btn-pulang').disabled = false;
//                 locationReady = true;
                
//                 // Show success status with accuracy info
//                 const locationStatusDiv = document.getElementById('location-status');
//                 locationStatusDiv.style.display = 'block';
//                 locationStatusDiv.style.borderColor = accuracyColor;
//                 document.getElementById('location-error').style.display = 'none';
                
//                 // Update location text dengan info akurasi
//                 document.getElementById('location-text').innerHTML = `
//                     <span class="font-semibold">${accuracyStatus} (±${Math.round(accuracy)}m)</span><br>
//                     <span class="text-xs opacity-75">Mengambil nama alamat...</span>
//                 `;
//             },
//             function(error) {
//                 console.error('❌ Error getting location:', error);
//                 let errorMessage = '';
//                 let errorDetail = '';
                
//                 switch(error.code) {
//                     case error.PERMISSION_DENIED:
//                         errorMessage = 'Izin Lokasi Ditolak';
//                         errorDetail = 'Aktifkan izin lokasi di pengaturan browser Anda, lalu refresh halaman.';
//                         break;
//                     case error.POSITION_UNAVAILABLE:
//                         errorMessage = 'GPS Tidak Tersedia';
//                         errorDetail = 'Pastikan GPS/Location Service aktif di perangkat Anda.';
//                         break;
//                     case error.TIMEOUT:
//                         errorMessage = 'Waktu Habis';
//                         errorDetail = 'GPS membutuhkan waktu terlalu lama. Coba refresh halaman atau pindah ke area terbuka.';
//                         break;
//                     default:
//                         errorMessage = 'Kesalahan Tidak Diketahui';
//                         errorDetail = 'Terjadi kesalahan saat mengambil lokasi. Coba lagi.';
//                 }
                
//                 document.getElementById('location-error').style.display = 'block';
//                 document.getElementById('location-status').style.display = 'none';
//                 document.getElementById('location-error').querySelector('p:first-of-type').textContent = errorMessage;
//                 document.getElementById('location-error').querySelector('p:last-child').textContent = errorDetail;
//                 document.getElementById('location-display').textContent = 'GPS Tidak Aktif';
//                 document.getElementById('location-display').style.color = '#f87171';
//             },
//             options  // ← PENTING: Tambahkan options untuk high accuracy
//         );
//     } else {
//         console.error('❌ Browser tidak support geolocation');
//         alert('Browser Anda tidak mendukung Geolocation');
//         document.getElementById('location-display').textContent = 'Tidak Didukung';
//         document.getElementById('location-display').style.color = '#f87171';
//     }
// }

// // Get address from coordinates using reverse geocoding
// function getAddressFromCoordinates(lat, lng, accuracy, accuracyStatus) {
//     const coords = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
//     console.log('Mengambil alamat untuk:', coords);
    
//     // Tambahkan User-Agent untuk Nominatim
//     fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`, {
//         headers: {
//             'User-Agent': 'AbsensiApp/1.0' // Required by Nominatim
//         }
//     })
//         .then(response => response.json())
//         .then(data => {
//             console.log('Data alamat:', data);
//             let address = 'Lokasi Terdeteksi';
//             let shortAddress = 'Lokasi Terdeteksi';
            
//             if (data.address) {
//                 const parts = [];
//                 const shortParts = [];
                
//                 // Untuk display lengkap
//                 if (data.address.road) parts.push(data.address.road);
//                 if (data.address.suburb) parts.push(data.address.suburb);
//                 if (data.address.village) parts.push(data.address.village);
//                 if (data.address.city) parts.push(data.address.city);
//                 if (data.address.county) parts.push(data.address.county);
                
//                 // Untuk display singkat di info card
//                 if (data.address.road) shortParts.push(data.address.road);
//                 if (data.address.suburb || data.address.village) {
//                     shortParts.push(data.address.suburb || data.address.village);
//                 }
//                 if (data.address.city) shortParts.push(data.address.city);
                
//                 address = parts.length > 0 ? parts.join(', ') : data.display_name;
//                 shortAddress = shortParts.length > 0 ? shortParts.join(', ') : address;
                
//                 // Batasi panjang untuk display
//                 if (shortAddress.length > 35) {
//                     shortAddress = shortAddress.substring(0, 32) + '...';
//                 }
//             }
            
//             // Update semua elemen display
//             document.getElementById('location-display').textContent = shortAddress;
//             document.getElementById('location-display').style.color = '#ffffff';
            
//             document.getElementById('location-text').innerHTML = `
//                 <span class="font-semibold">${accuracyStatus} (±${Math.round(accuracy)}m)</span><br>
//                 <span class="text-xs opacity-90">${address}</span><br>
//                 <span class="text-xs opacity-75 font-mono">${coords}</span>
//             `;
            
//             document.getElementById('location_address').value = address;
//             console.log('✅ Alamat berhasil diset:', address);
//         })
//         .catch(error => {
//             console.error('Error getting address:', error);
//             document.getElementById('location-display').textContent = coords;
//             document.getElementById('location-display').style.color = '#ffffff';
            
//             document.getElementById('location-text').innerHTML = `
//                 <span class="font-semibold">${accuracyStatus} (±${Math.round(accuracy)}m)</span><br>
//                 <span class="text-xs opacity-75 font-mono">${coords}</span><br>
//                 <span class="text-xs opacity-75">Alamat tidak dapat diambil</span>
//             `;
            
//             document.getElementById('location_address').value = coords;
//         });
// }

    // Update time display every second
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit',
            hour12: false 
        });
        document.getElementById('current-time').textContent = timeString;
    }

    // Call functions when page loads
    getLocation();
    updateClientTime();
    setInterval(updateTime, 1000);

    // Auto-hide success alert after 5 seconds
    setTimeout(function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 5000);

    // Handle form submission
    document.getElementById('attendance-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const clickedButton = e.submitter;
        const typeValue = clickedButton ? clickedButton.value : null;
        
        console.log('=== FORM SUBMIT DEBUG ===');
        console.log('Type:', typeValue);
        console.log('locationReady:', locationReady);
        console.log('Latitude:', document.getElementById('latitude').value);
        console.log('Longitude:', document.getElementById('longitude').value);
        console.log('Address:', document.getElementById('location_address').value);
        
        if (!locationReady || !document.getElementById('latitude').value) {
            alert('Mohon tunggu, lokasi sedang dideteksi...');
            return false;
        }
        
        if (!typeValue) {
            alert('Tipe absensi tidak terdeteksi!');
            return false;
        }
        
        // Update client time SEBELUM submit
        updateClientTime();
        
        console.log('Client Time:', document.getElementById('client_time').value);
        console.log('========================');
        
        // Add hidden input for type
        const typeInput = document.createElement('input');
        typeInput.type = 'hidden';
        typeInput.name = 'type';
        typeInput.value = typeValue;
        this.appendChild(typeInput);
        
        console.log('✅ Submitting form...');
        this.submit();
    });
   // Auto-hide error alert after 5 seconds
setTimeout(function() {
    const alert = document.getElementById('error-alert');
    if (alert) {
        alert.style.transition = 'opacity 0.5s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    }
}, 5000);
</script>
</x-app-layout>