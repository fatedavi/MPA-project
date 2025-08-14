<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Event Baru</h2>
    </x-slot>

    <div class="py-6 max-w-lg mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('events.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block font-semibold mb-1">Nama Event</label>
                    <input type="text" id="name" name="name"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block font-semibold mb-1">Deskripsi</label>
                    <textarea id="description" name="description" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="reward" class="block font-semibold mb-1">Reward (Rp)</label>
                    <input type="number" id="reward" name="reward"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" min="0" required
                        value="{{ old('reward') }}">
                    @error('reward')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="date" class="block font-semibold mb-1">Tanggal & Waktu Event</label>
                    <input type="datetime-local" id="date" name="date"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required
                        value="{{ old('date') }}">
                    @error('date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2.5 rounded-lg shadow hover:bg-blue-700 transition">
                        Simpan Event
                    </button>

                    <a href="{{ route('events.index') }}"
                        class="bg-gray-500 text-white px-5 py-2.5 rounded-lg shadow hover:bg-gray-600 transition">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>


</x-app-layout>
