{{-- resources/views/salary/my.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Salary History') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">
                    Gaji {{ $employee->name }}
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 text-left">Bulan</th>
                                <th class="px-4 py-3 text-left">Tahun</th>
                                <th class="px-4 py-3 text-right">Gaji Pokok</th>
                                <th class="px-4 py-3 text-right">Bonus Absen</th>
                                <th class="px-4 py-3 text-right">Reward Event</th>
                                <th class="px-4 py-3 text-right">Potongan Cuti</th>
                                <th class="px-4 py-3 text-right">Total Gaji</th>
                                <th class="px-4 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($salaries as $salary)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-2">{{ $salary->month }}</td>
                                    <td class="px-4 py-2">{{ $salary->year }}</td>
                                    <td class="px-4 py-2 text-right">
                                        Rp{{ number_format($salary->base_salary, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 text-right">
                                        Rp{{ number_format($salary->total_bonus, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 text-right">
                                        Rp{{ number_format($salary->total_event_reward, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 text-right text-red-600">
                                        Rp{{ number_format($salary->potongan_cuti, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 text-right font-bold text-green-700">
                                        Rp{{ number_format($salary->total_salary, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $salary->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($salary->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-4 text-center text-gray-500">
                                        Belum ada data gaji.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
