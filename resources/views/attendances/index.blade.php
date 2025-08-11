<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Attendance</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">

            {{-- Jam Sekarang --}}
            <div id="clock" class="text-5xl font-extrabold mb-2 tracking-widest"></div>

            {{-- Status Tepat Waktu / Telat --}}
            @php
                $now = \Carbon\Carbon::now();
                $statusWaktu = $now->greaterThan(\Carbon\Carbon::parse('08:15')) ? 'Telat' : 'Tepat Waktu';
                $warnaStatus = $statusWaktu === 'Telat' ? 'bg-red-500' : 'bg-green-500';
            @endphp

            <span id="status-waktu" class="{{ $warnaStatus }} text-white px-4 py-1 rounded-full text-sm font-semibold inline-block mb-4">
                {{ $statusWaktu }}
            </span>

            {{-- Pesan sukses / error --}}
            @if(session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 text-red-600">{{ session('error') }}</div>
            @endif

            {{-- Tombol Absen --}}
            <form method="POST" action="{{ route('attendance.proses') }}">
                @csrf
                @if(!$absen)
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-lg shadow-md transition">
                        ✅ Check In
                    </button>
                @elseif(!$absen->check_out)
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg text-lg shadow-md transition">
                        🕒 Check Out
                    </button>
                @else
                    <p class="text-gray-600">✅ Sudah absen hari ini</p>
                @endif
            </form>

            {{-- Info Absensi Hari Ini --}}
            @if($absen)
                <div class="mt-6 text-left">
                    <p><strong>Check In:</strong> {{ $absen->check_in ?? '-' }}</p>
                    <p><strong>Check Out:</strong> {{ $absen->check_out ?? '-' }}</p>
                    <p><strong>Bonus:</strong> Rp {{ number_format($absen->bonus, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong> {{ $absen->status }}</p>
                </div>
            @endif

        </div>
        {{-- Riwayat Absensi --}}
<div class="mt-8">
    <h3 class="text-lg font-semibold mb-3">Riwayat Absensi</h3>
    <table class="min-w-full border border-gray-300 text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Check In</th>
                <th class="border p-2">Check Out</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Bonus</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayat as $r)
                <tr>
                    <td class="border p-2">{{ $r->date }}</td>
                    <td class="border p-2">{{ $r->check_in ?? '-' }}</td>
                    <td class="border p-2">{{ $r->check_out ?? '-' }}</td>
                    <td class="border p-2">{{ $r->status }}</td>
                    <td class="border p-2">Rp {{ number_format($r->bonus, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border p-2 text-center text-gray-500">
                        Belum ada riwayat absensi
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

    </div>
    

    <script>
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('id-ID', { hour12: false });
            document.getElementById('clock').textContent = time;

            // Perbarui status waktu secara realtime
            const cutoff = new Date();
            cutoff.setHours(8, 15, 0, 0);
            const statusEl = document.getElementById('status-waktu');
            if (now > cutoff) {
                statusEl.textContent = 'Telat';
                statusEl.className = 'bg-red-500 text-white px-4 py-1 rounded-full text-sm font-semibold inline-block mb-4';
            } else {
                statusEl.textContent = 'Tepat Waktu';
                statusEl.className = 'bg-green-500 text-white px-4 py-1 rounded-full text-sm font-semibold inline-block mb-4';
            }
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</x-app-layout>
