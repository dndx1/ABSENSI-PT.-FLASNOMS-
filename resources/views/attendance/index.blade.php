<!DOCTYPE html>
<html>
<head>
    <title>Web Absensi ST</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-6 rounded-xl shadow-md w-full max-w-3xl">
    <h2 class="text-2xl font-bold mb-4 text-center">Web Absensi Karyawan</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/attendance" class="flex gap-2 mb-6">
        @csrf
        <input 
            type="text" 
            name="employee_name" 
            placeholder="Nama Karyawan"
            class="flex-1 border rounded px-3 py-2"
            required
        >

        <input type="hidden" name="client_time" id="client_time">

        <button 
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
        >
            Absen
        </button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Client Time</th>
                    <th class="p-2 border">Server Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $a)
                <tr class="text-center">
                    <td class="p-2 border">{{ $a->employee_name }}</td>
                    <td class="p-2 border">{{ $a->client_time }}</td>
                    <td class="p-2 border">{{ $a->server_time }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('client_time').value = new Date().toISOString();
</script>

</body>

</html>
