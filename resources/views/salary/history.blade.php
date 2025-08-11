<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Gaji Karyawan - Bulan {{ $months[$month] ?? $month }} {{ $year }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6 overflow-x-auto">

            <form method="GET" action="{{ route('salary.history') }}" class="mb-4 flex space-x-4 items-center">
                <div>
                    <label for="month" class="block text-sm font-medium text-gray-700">Bulan</label>
                    <select name="month" id="month" class="border-gray-300 rounded-md">
                        @foreach($months as $num => $name)
                            <option value="{{ $num }}" @selected($num == $month)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700">Tahun</label>
                    <select name="year" id="year" class="border-gray-300 rounded-md">
                        @foreach($years as $y)
                            <option value="{{ $y }}" @selected($y == $year)>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" 
                        class="mt-6 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Filter
                    </button>
                </div>
            </form>

            @if($salaries->isEmpty())
                <div class="text-center text-gray-500 py-6">Belum ada data gaji untuk bulan dan tahun ini.</div>
            @else
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
                            <th class="border px-4 py-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salaries as $salary)
                        <tr>
                            <td class="border px-4 py-2">{{ $salary->employee->name }}</td>
                            <td class="border px-4 py-2 text-right">{{ number_format($salary->base_salary, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-right">{{ number_format($salary->total_bonus, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-right">{{ number_format($salary->total_event_reward, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-right">{{ $salary->total_cut }}</td>
                            <td class="border px-4 py-2 text-right">{{ number_format($salary->potongan_cuti, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-right font-bold text-green-700">{{ number_format($salary->total_salary, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-center">{{ ucfirst($salary->status) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>
</x-app-layout>
