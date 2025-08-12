<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Kehadiran Event</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">

            @if(session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            <div class="mb-4 text-right">
                <a href="{{ route('event-attendances.create') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                   + Tambah Kehadiran
                </a>
            </div>

            @php
                // Group attendances by event
                $groupedAttendances = $attendances->groupBy('event.name');
            @endphp

            @forelse ($groupedAttendances as $eventName => $eventAttendances)
                <div class="mb-6 border border-gray-300 rounded-lg shadow-sm">
                    <div class="bg-gray-100 px-4 py-2 font-semibold text-lg">
                        {{ $eventName }}
                    </div>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="border border-gray-300 px-4 py-2 w-12">#</th>
                                <th class="border border-gray-300 px-4 py-2">Pegawai</th>
                                <th class="border border-gray-300 px-4 py-2">Tanggal Daftar</th>
                                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eventAttendances as $index => $attendance)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $attendance->employee->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $attendance->created_at->format('d M Y') }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <form action="{{ route('event-attendances.destroy', $attendance->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @empty
                <p class="text-center py-4">Belum ada data kehadiran.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
