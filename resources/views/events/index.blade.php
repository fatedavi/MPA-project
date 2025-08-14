<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Event</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                    📋 Daftar Event
                </h3>
            </div>

            @if (session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tombol Tambah + Search sejajar --}}
            <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <form method="GET" action="{{ route('events.index') }}" class="flex gap-2 w-full sm:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari event..."
                        class="border rounded-lg px-4 py-2 w-full sm:w-64 focus:outline-none focus:ring focus:border-blue-300">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Search
                    </button>
                </form>
                <a href="{{ route('events.create') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow transition font-medium">
                    + Tambah Event
                </a>

            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">Nama Event</th>
                            <th class="px-6 py-3 text-left">Deskripsi</th>
                            <th class="px-6 py-3 text-left">Tanggal</th>
                            <th class="px-6 py-3 text-right">Reward</th>
                            <th class="px-6 py-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($events as $event)
                            <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100 transition">
                                <td class="px-6 py-4">{{ $event->name }}</td>
                                <td class="px-6 py-4">{{ $event->description ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $event->date->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 text-right">Rp {{ number_format($event->reward, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($event->status === 'approve')
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Disetujui
                                        </span>
                                    @elseif($event->status === 'reject')
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Coming Soon
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-6 text-center text-gray-500 text-base">
                                    Belum ada data event.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $events->links() }}
            </div>
        </div>
    </div>



</x-app-layout>
