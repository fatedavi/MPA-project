<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perusahaan Management') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right w-6 h-6 text-gray-400"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Perusahaan</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-400 rounded-full">
                            <i class="fas fa-building text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-blue-100 text-sm font-medium">Total Perusahaan</p>
                            <p class="text-2xl font-bold">{{ $perusahaan->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-400 rounded-full">
                            <i class="fas fa-map-marker-alt text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-100 text-sm font-medium">Kota Berbeda</p>
                            <p class="text-2xl font-bold">{{ $perusahaan->getCollection()->unique('kota')->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-400 rounded-full">
                            <i class="fas fa-user-tie text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-purple-100 text-sm font-medium">Total Pemilik</p>
                            <p class="text-2xl font-bold">{{ $perusahaan->getCollection()->unique('pemilik')->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-orange-400 rounded-full">
                            <i class="fas fa-envelope text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-orange-100 text-sm font-medium">Email Aktif</p>
                            <p class="text-2xl font-bold">
                                {{ $perusahaan->getCollection()->whereNotNull('email')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-building text-[#8D0907]"></i>
                            Daftar Perusahaan
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Kelola data perusahaan yang tersedia
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    @if (session('success'))
                        <div
                            class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('perusahaan.create') }}"
                                class="inline-flex items-center px-6 py-3 bg-[#8D0907] text-white rounded-lg hover:bg-[#6B0705] transition-colors shadow-md hover:shadow-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Perusahaan
                            </a>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    {{-- <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-image mr-2"></i>Logo
                                    </th> --}}
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-building mr-2"></i>Nama Perusahaan
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-user-tie mr-2"></i>Pemilik
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-map-marker-alt mr-2"></i>Kota
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-envelope mr-2"></i>Email
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-cogs mr-2"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($perusahaan as $per)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-lg flex items-center justify-center text-white font-semibold text-lg">
                                                {{ substr($per->nama_perusahaan, 0, 2) }}
                                            </div>
                                        </td> --}}
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $per->nama_perusahaan }}</div>
                                                    <div class="text-sm text-gray-500 max-w-xs truncate"
                                                        title="{{ $per->alamat }}">
                                                        <i class="fas fa-map-marker-alt mr-1 text-[#8D0907]"></i>
                                                        {{ $per->alamat }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                <i class="fas fa-user-tie mr-1 text-[#8D0907]"></i>
                                                {{ $per->pemilik }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-map-marker-alt mr-1"></i>
                                                {{ $per->kota }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($per->email)
                                                <a href="mailto:{{ $per->email }}"
                                                    class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
                                                    <i class="fas fa-envelope mr-1"></i>
                                                    {{ $per->email }}
                                                </a>
                                            @else
                                                <span class="text-sm text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('perusahaan.show', $per->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-white text-sm rounded-lg hover:bg-blue-600 transition-colors"
                                                    title="Lihat Detail">
                                                    <i class="fas fa-eye mr-1"></i>
                                                    View
                                                </a>
                                                <a href="{{ route('perusahaan.edit', $per->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-sm rounded-lg hover:bg-yellow-600 transition-colors"
                                                    title="Edit">
                                                    <i class="fas fa-edit mr-1"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('perusahaan.destroy', $per->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus perusahaan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition-colors"
                                                        title="Hapus">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center text-gray-500">
                                                <i class="fas fa-building text-4xl mb-3 text-gray-300"></i>
                                                <p class="text-lg font-medium">Belum ada data perusahaan</p>
                                                <p class="text-sm">Data perusahaan akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($perusahaan->hasPages())
                        <div class="mt-6">
                            {{ $perusahaan->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
