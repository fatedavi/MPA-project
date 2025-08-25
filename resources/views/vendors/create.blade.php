<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Vendor
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('vendors.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_vendor" class="block text-sm font-medium text-gray-700">Nama Vendor *</label>
                            <input type="text" name="nama_vendor" id="nama_vendor" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="up_vendor" class="block text-sm font-medium text-gray-700">UP Vendor *</label>
                            <input type="text" name="up_vendor" id="up_vendor" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="no_telp" class="block text-sm font-medium text-gray-700">No Telp *</label>
                            <input type="number" name="no_telp" id="no_telp" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="email_vendor" class="block text-sm font-medium text-gray-700">Email Vendor
                                *</label>
                            <input type="email" name="email_vendor" id="email_vendor" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="kota" class="block text-sm font-medium text-gray-700">Kota *</label>
                            <input type="text" name="kota" id="kota" required
                                class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>
                        <div class="md:col-span-2">
                            <label for="alamat_vendor" class="block text-sm font-medium text-gray-700">Alamat Vendor
                                *</label>
                            <textarea name="alamat_vendor" id="alamat_vendor" rows="3" required
                                class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <a href="{{ route('vendors.index') }}" class="px-4 py-2 bg-gray-200 rounded mr-2">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-[#8D0907] text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
