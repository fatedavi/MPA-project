<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Vendor') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Tombol Back -->
                    <div class="mb-6">
                        <a href="{{ route('vendors.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                    </div>

                    <!-- Detail Vendor -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="md:col-span-2">
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 mb-4">Informasi Vendor</h4>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Kode
                                                Vendor</label>
                                            <p class="text-sm text-gray-900">{{ $vendor->id_vendor }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Nama
                                                Vendor</label>
                                            <p class="text-sm text-gray-900">{{ $vendor->nama_vendor }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Kota</label>
                                            <p class="text-sm text-gray-900">{{ $vendor->kota }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">UP</label>
                                            <p class="text-sm text-gray-900">{{ $vendor->up_vendor }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">No.
                                                Telepon</label>
                                            <p class="text-sm text-gray-900">{{ $vendor->no_telp }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                                            <p class="text-sm text-gray-900">{{ $vendor->email_vendor }}</p>
                                        </div>

                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Alamat</label>
                                            <p class="text-sm text-gray-900">{{ $vendor->alamat_vendor }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer: waktu dibuat/diupdate -->
                                <div class="pt-4 border-t border-gray-200">
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <span>Dibuat: {{ $vendor->created_at->format('d M Y H:i') }}</span>
                                        <span>Diupdate: {{ $vendor->updated_at->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end grid -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
