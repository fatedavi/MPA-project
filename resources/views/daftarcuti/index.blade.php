<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Pengajuan Cuti
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div
                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                        📋 Daftar Cuti Karyawan
                    </h3>
                </div>
                <div class="p-6 text-gray-900">

                    {{-- Form Search --}}
                    <div class="mb-4">
                        <form method="GET" action="{{ route('cuti.admin.index') }}" class="flex gap-2">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama, tanggal, atau keterangan..."
                                class="border border-gray-300 rounded-lg px-3 py-2 max-w-xs focus:ring focus:ring-blue-200">
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                Cari
                            </button>
                        </form>
                    </div>


                    {{-- Tabel --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Karyawan
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Durasi</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Keterangan</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($cuti as $item)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">{{ $item->employee->name }}</td>
                                        <td class="px-6 py-4">{{ $item->tanggal }}</td>
                                        <td class="px-6 py-4">{{ $item->day }} hari</td>
                                        <td class="px-6 py-4">{{ $item->description }}</td>
                                        <td class="px-6 py-4">
                                            @if ($item->status === 'requested')
                                                <div class="flex gap-2">
                                                    <form action="{{ route('cuti.approve', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="p-2 bg-green-500 text-white rounded-lg hover:bg-green-600"
                                                            title="Setujui">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('cuti.reject', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                                                            title="Tolak">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                @php
                                                    $badgeColor = match ($item->status) {
                                                        'approved' => 'bg-green-100 text-green-800',
                                                        'rejected' => 'bg-red-100 text-red-800',
                                                        default => 'bg-yellow-100 text-yellow-800',
                                                    };
                                                @endphp
                                                <span
                                                    class="px-3 py-1 text-xs font-semibold rounded-full {{ $badgeColor }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Belum ada pengajuan cuti.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $cuti->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
