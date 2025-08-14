<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Event</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                    📋 Daftar Persetujuan Event
                </h3>
            </div>

            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            {{-- Form Search --}}
            <form method="GET" action="{{ route('events.admin') }}" class="mb-4 flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama atau deskripsi event..."
                    class="border border-gray-300 rounded-lg px-3 py-2 max-w-xs focus:ring focus:ring-blue-200">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Cari
                </button>
            </form>

            {{-- Tabel --}}
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Nama Event</th>
                        <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                        <th class="border border-gray-300 px-4 py-2">Reward</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $event->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $event->description ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $event->date->format('d M Y H:i') }}</td>
                            <td class="border border-gray-300 px-4 py-2">Rp
                                {{ number_format($event->reward, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if ($event->status === 'approve')
                                    <span class="text-green-600 font-semibold">Disetujui</span>
                                @elseif($event->status === 'reject')
                                    <span class="text-red-600 font-semibold">Ditolak</span>
                                @else
                                    <span class="text-yellow-600 font-semibold">Coming Soon</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if ($event->status === 'comingsoon')
                                    <form action="{{ route('events.updateStatus', $event->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="status" value="approve"
                                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded mr-1">
                                            Approve
                                        </button>
                                        <button type="submit" name="status" value="reject"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                            Reject
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500">No action</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada data event.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $events->withQueryString()->links() }}
            </div>

        </div>
    </div>

</x-app-layout>
