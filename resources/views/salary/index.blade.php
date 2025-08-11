<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Gaji Karyawan Bulan {{ \Carbon\Carbon::now()->format('F Y') }}</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6 overflow-x-auto">
            @if(session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif
<a href="{{ route('salary.save') }}" 
   class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block mr-2">
    Simpan Gaji Bulan Ini
</a>

<a href="{{ route('salary.history') }}"
   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
    Lihat Riwayat Gaji
</a>


            <table class="min-w-full border border-gray-300 rounded">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Nama Karyawan</th>
                        <th class="border px-4 py-2 text-right">Base Salary (Rp)</th>
                        <th class="border px-4 py-2 text-right">Bonus Attendance (Rp)</th>
                        <th class="border px-4 py-2 text-right">Reward Event (Rp)</th>
                        <th class="border px-4 py-2 text-right">Cuti (Hari)</th>
                        <th class="border px-4 py-2 text-right">Potongan Cuti (Rp)</th>
                        <th class="border px-4 py-2 text-right font-bold">Total Gaji (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salaryData as $data)
                    <tr>
                        <td class="border px-4 py-2">{{ $data['employee']->name }}</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($data['base_salary'], 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($data['total_bonus'], 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($data['total_event_reward'], 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 text-right">{{ $data['total_cuti_days'] }}</td>
                        <td class="border px-4 py-2 text-right">{{ number_format($data['potongan_cuti'], 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 text-right font-bold text-green-700">{{ number_format($data['total_salary'], 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="border px-4 py-2 text-center text-gray-500">Belum ada data gaji.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
