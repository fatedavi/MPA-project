<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajukan Cuti
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <form action="{{ route('cuti.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="tanggal" class="block font-medium">Tanggal Cuti</label>
                        <input type="date" name="tanggal" id="tanggal"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="day" class="block font-medium">Jumlah Hari</label>
                        <input type="number" name="day" id="day" min="1"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium">Keterangan</label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="flex items-center space-x-3">
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Ajukan Cuti
                        </button>
                        <a href="{{ route('cuti.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
