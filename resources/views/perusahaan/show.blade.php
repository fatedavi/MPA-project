<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Perusahaan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6 flex justify-between items-center">
                        <a href="{{ route('perusahaan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali
                        </a>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" class="inline-flex items-center px-4 py-2 bg-[#8D0907] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#B91C1C] focus:bg-[#B91C1C] active:bg-[#8D0907] focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Company Logo/Info -->
                        <div class="md:col-span-1">
                            <div class="bg-gray-50 rounded-lg p-6 text-center">
                                <div class="w-32 h-32 mx-auto mb-4 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-lg flex items-center justify-center text-white font-bold text-3xl">
                                    {{ substr($perusahaan->nama_perusahaan, 0, 2) }}
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $perusahaan->nama_perusahaan }}</h3>
                                <p class="text-sm text-gray-500">{{ $perusahaan->kota }}</p>
                            </div>
                        </div>

                        <!-- Company Details -->
                        <div class="md:col-span-2">
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 mb-4">Informasi Perusahaan</h4>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Nama Perusahaan</label>
                                            <p class="text-sm text-gray-900">{{ $perusahaan->nama_perusahaan }}</p>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Pemilik</label>
                                            <p class="text-sm text-gray-900">{{ $perusahaan->pemilik }}</p>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Kota</label>
                                            <p class="text-sm text-gray-900">{{ $perusahaan->kota }}</p>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                                            <p class="text-sm text-gray-900">{{ $perusahaan->email }}</p>
                                        </div>
                                        
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Alamat</label>
                                            <p class="text-sm text-gray-900">{{ $perusahaan->alamat }}</p>
                                        </div>
                                        
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">File Gambar</label>
                                            <p class="text-sm text-gray-900">{{ $perusahaan->gambar }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-gray-200">
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <span>Dibuat: {{ $perusahaan->created_at->format('d M Y H:i') }}</span>
                                        <span>Diupdate: {{ $perusahaan->updated_at->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
