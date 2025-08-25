<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Client') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('clients.update', $client->id_client) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nama Client -->
                        <div class="mb-4">
                            <label for="nama_client" class="block text-sm font-medium text-gray-700">Nama Client *</label>
                            <input type="text" name="nama_client" id="nama_client" 
                                   value="{{ old('nama_client', $client->nama_client) }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                        </div>

                        <!-- Alamat Client -->
                        <div class="mb-4">
                            <label for="alamat_client" class="block text-sm font-medium text-gray-700">Alamat Client *</label>
                            <textarea name="alamat_client" id="alamat_client" rows="3"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">{{ old('alamat_client', $client->alamat_client) }}</textarea>
                        </div>

                        <!-- UP -->
                        <div class="mb-4">
                            <label for="up" class="block text-sm font-medium text-gray-700">UP *</label>
                            <input type="text" name="up" id="up" 
                                   value="{{ old('up', $client->up) }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                        </div>

                        <!-- UP SPH -->
                        <div class="mb-4">
                            <label for="upsph" class="block text-sm font-medium text-gray-700">UP SPH *</label>
                            <input type="text" name="upsph" id="upsph" 
                                   value="{{ old('upsph', $client->upsph) }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-[#8D0907] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#B91C1C] focus:bg-[#B91C1C] active:bg-[#8D0907] focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Client
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
