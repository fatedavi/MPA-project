<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Kehadiran Event</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                    📋 Daftar Kehadiran Event Karyawan
                </h3>
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">{{ session('success') }}</div>
            @endif

            {{-- Tombol + Form Search --}}
            <div class="flex flex-col sm:flex-row sm:justify-between items-center gap-3">

                <form method="GET" action="{{ route('event-attendances.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ $search ?? '' }}"
                        placeholder="Cari nama pegawai atau event..."
                        class="border border-gray-300 rounded-lg px-3 py-2 max-w-xs focus:ring focus:ring-blue-200">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Cari
                    </button>
                </form>
                <a href="{{ route('event-attendances.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    + Tambah Kehadiran
                </a>
            </div>

            @php
                $groupedAttendances = $attendances->groupBy('event.name');
            @endphp

            {{-- List Event --}}
            @forelse ($groupedAttendances as $eventName => $eventAttendances)
                <div class="rounded-lg overflow-hidden border border-gray-200 shadow">
                    <div class="px-6 py-3 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">{{ $eventName }}</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pegawai
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal
                                        Daftar</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($eventAttendances as $index => $attendance)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ $attendance->employee->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $attendance->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('event-attendances.destroy', $attendance->id) }}"
                                                method="POST" onsubmit="return confirm('Hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1 text-xs text-white bg-red-600 rounded hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 bg-gray-50 rounded-lg">
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data kehadiran</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan data kehadiran baru.</p>
                </div>
            @endforelse

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $attendances->links() }}
            </div>
        </div>
    </div>

</x-app-layout>
