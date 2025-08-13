<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Gaji Karyawan Bulan
            {{ \Carbon\Carbon::now()->format('F Y') }}</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6 overflow-x-auto">

            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tombol aksi --}}
            <div class="flex flex-wrap gap-3 mb-4">
                <!-- Tombol Simpan Gaji -->
                <a href="{{ route('salary.save') }}"
                    class="flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-700 text-white px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg hover:from-green-600 hover:to-green-800 transition-all duration-300 ease-in-out">
                    <i class="fas fa-save text-lg"></i>
                    <span class="font-medium">💾Simpan Gaji Bulan Ini</span>
                </a>

                <!-- Tombol Lihat Riwayat -->
                <a href="{{ route('salary.history') }}"
                    class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg hover:from-blue-600 hover:to-blue-800 transition-all duration-300 ease-in-out">
                    <i class="fas fa-history text-lg"></i>
                    <span class="font-medium">📜Lihat Riwayat Gaji</span>
                </a>
            </div>


            {{-- Tabel gaji --}}
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Karyawan</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Base Salary (Rp)</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Bonus Attendance (Rp)</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Reward Event (Rp)</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Cuti (Hari)</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Potongan Cuti (Rp)</th>
                        <th class="px-6 py-3 text-right text-sm font-bold text-gray-900">Total Gaji (Rp)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($salaryData as $data)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $data['employee']->name }}</td>
                            <td class="px-6 py-4 text-right">{{ number_format($data['base_salary'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right">{{ number_format($data['total_bonus'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right">
                                {{ number_format($data['total_event_reward'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-right">{{ $data['total_cuti_days'] }}</td>
                            <td class="px-6 py-4 text-right">{{ number_format($data['potongan_cuti'], 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 font-semibold">
                                    {{ number_format($data['total_salary'], 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Belum ada data gaji.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</x-app-layout>
