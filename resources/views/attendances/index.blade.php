<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance Check-in') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right w-6 h-6 text-gray-400"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Attendance</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Main Check-in Card -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 mb-8">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-center">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-clock text-[#8D0907]"></i>
                            Sistem Absensi Karyawan
                        </h3>
                    </div>
                </div>

                <div class="p-8 text-center">
                    <!-- Real-time Clock -->
                    <div class="mb-6">
                        <div id="clock" class="text-6xl font-extrabold text-gray-800 mb-3 tracking-widest font-mono"></div>
                        <div class="text-lg text-gray-600">
                            <i class="fas fa-calendar-day mr-2 text-[#8D0907]"></i>
                            {{ \Carbon\Carbon::now()->format('l, d F Y') }}
                        </div>
                    </div>

                    <!-- Status Badge -->
                    @php
                        $now = \Carbon\Carbon::now();
                        $statusWaktu = $now->greaterThan(\Carbon\Carbon::parse('08:15')) ? 'Telat' : 'Tepat Waktu';
                        $warnaStatus = $statusWaktu === 'Telat' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800';
                        $iconStatus = $statusWaktu === 'Telat' ? 'fa-exclamation-triangle' : 'fa-check-circle';
                    @endphp

                    <div class="mb-6">
                        <span id="status-waktu" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $warnaStatus }}">
                            <i class="fas {{ $iconStatus }} mr-2"></i>
                            {{ $statusWaktu }}
                        </span>
                    </div>

                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-center max-w-md mx-auto">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center justify-center max-w-md mx-auto">
                            <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Attendance Button -->
                    <form method="POST" action="{{ route('attendance.proses') }}" class="mb-8">
                        @csrf
                        @if(!$absen)
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Check In
                            </button>
                        @elseif(!$absen->check_out)
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Check Out
                            </button>
                        @else
                            <div class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-600 rounded-lg text-lg font-semibold">
                                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                                Sudah Absen Hari Ini
                            </div>
                        @endif
                    </form>

                    <!-- Today's Attendance Info -->
                    @if($absen)
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-6 max-w-md mx-auto">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center justify-center">
                                <i class="fas fa-info-circle mr-2 text-[#8D0907]"></i>
                                Informasi Absensi Hari Ini
                            </h4>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div class="text-center">
                                    <div class="font-medium text-gray-600">Check In</div>
                                    <div class="text-lg font-bold text-green-600">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $absen->check_in ?? '-' }}
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="font-medium text-gray-600">Check Out</div>
                                    <div class="text-lg font-bold text-blue-600">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $absen->check_out ?? 'Belum Check Out' }}
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="font-medium text-gray-600">Bonus</div>
                                    <div class="text-lg font-bold text-purple-600">
                                        <i class="fas fa-coins mr-1"></i>
                                        Rp {{ number_format($absen->bonus, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="font-medium text-gray-600">Status</div>
                                    <div class="text-lg font-bold {{ $absen->status == 'Hadir' ? 'text-green-600' : 'text-yellow-600' }}">
                                        <i class="fas fa-info mr-1"></i>
                                        {{ $absen->status }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Attendance History -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-history text-[#8D0907]"></i>
                        Riwayat Absensi
                    </h3>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-calendar mr-2"></i>Tanggal
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-sign-in-alt mr-2"></i>Check In
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Check Out
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-info-circle mr-2"></i>Status
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-coins mr-2"></i>Bonus
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($riwayat as $r)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <i class="fas fa-calendar-alt mr-2 text-[#8D0907]"></i>
                                            {{ \Carbon\Carbon::parse($r->date)->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($r->date)->format('l') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($r->check_in)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ $r->check_in }}
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($r->check_out)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ $r->check_out }}
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusClass = match($r->status) {
                                                'Hadir' => 'bg-green-100 text-green-800',
                                                'Terlambat' => 'bg-yellow-100 text-yellow-800',
                                                'Tidak Hadir' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                            $statusIcon = match($r->status) {
                                                'Hadir' => 'fa-check',
                                                'Terlambat' => 'fa-exclamation-triangle',
                                                'Tidak Hadir' => 'fa-times',
                                                default => 'fa-info'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                            <i class="fas {{ $statusIcon }} mr-1"></i>
                                            {{ $r->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="text-sm font-bold text-purple-600">
                                            Rp {{ number_format($r->bonus, 0, ',', '.') }}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center text-gray-500">
                                            <i class="fas fa-history text-4xl mb-3 text-gray-300"></i>
                                            <p class="text-lg font-medium">Belum ada riwayat absensi</p>
                                            <p class="text-sm">Riwayat absensi akan muncul di sini</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if(method_exists($riwayat, 'hasPages') && $riwayat->hasPages())
                        <div class="mt-6">
                            {{ $riwayat->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('id-ID', { hour12: false });
            document.getElementById('clock').textContent = time;

            // Update status waktu secara realtime
            const cutoff = new Date();
            cutoff.setHours(8, 15, 0, 0);
            const statusEl = document.getElementById('status-waktu');
            
            if (now > cutoff) {
                statusEl.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i>Telat';
                statusEl.className = 'inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-800';
            } else {
                statusEl.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Tepat Waktu';
                statusEl.className = 'inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800';
            }
        }
        
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</x-app-layout>