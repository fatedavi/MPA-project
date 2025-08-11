<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Pengajuan Cuti
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Tombol Ajukan Cuti --}}
            <div class="flex justify-end">
                <a href="{{ route('cuti.create') }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    + Ajukan Cuti
                </a>
            </div>

            {{-- Daftar Pengajuan Cuti --}}
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-bold mb-4">Daftar Pengajuan Cuti</h3>
                <table class="w-full border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Tanggal</th>
                            <th class="px-4 py-2 border">Hari</th>

                            <th class="px-4 py-2 border">Keterangan</th>
                            <th class="px-4 py-2 border">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cuti as $index => $item)
                            <tr>
                                <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 border">{{ $item->tanggal }}</td>
                                <td class="px-4 py-2 border">{{ $item->day }}</td>
                                <td class="px-4 py-2 border">{{ $item->description }}</td>
                                <td class="px-4 py-2 border">
                                    @if ($item->status == 'approve')
                                        <span class="text-green-600 font-bold">Disetujui</span>
                                    @elseif($item->status == 'rejected')
                                        <span class="text-red-600 font-bold">Ditolak</span>
                                    @else
                                        <span class="text-yellow-600 font-bold">Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                    Belum ada pengajuan cuti
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
