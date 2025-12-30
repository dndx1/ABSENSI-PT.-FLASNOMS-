<x-app-layout>
    <x-slot name="header">
        Dashboard Admin
    </x-slot>

    <div class="p-6">
        <h2 class="text-lg font-bold mb-4">Laporan Absensi</h2>

        <table class="w-full border">
            <tr>
                <th>User</th>
                <th>Client Time</th>
                <th>Server Time</th>
            </tr>
            @foreach($attendances as $a)
            <tr>
                <td>{{ $a->user->name ?? '-' }}</td>
                <td>{{ $a->client_time }}</td>
                <td>{{ $a->server_time }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
