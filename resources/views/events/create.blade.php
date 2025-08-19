<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-lg flex items-center justify-center shadow-lg">
                <i class="fas fa-calendar-alt text-white text-sm"></i>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">Tambah Event Baru</h2>
        </div>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Event Baru</h1>
                <p class="text-gray-600 text-lg">Isi informasi event yang akan dibuat</p>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white shadow-xl rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                    <i class="fas fa-plus-circle text-[#8D0907]"></i>
                    Form Event
                </h3>
            </div>

            <form action="{{ route('events.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <!-- Nama Event -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar text-[#8D0907] mr-2"></i>
                        Nama Event
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar text-gray-400"></i>
                        </div>
                        <input type="text" id="name" name="name"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-all duration-200 text-gray-700 placeholder-gray-500"
                            placeholder="Masukkan nama event" required value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <p class="text-red-600 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-align-left text-[#8D0907] mr-2"></i>
                        Deskripsi Event
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                            <i class="fas fa-align-left text-gray-400"></i>
                        </div>
                        <textarea id="description" name="description" rows="4"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-all duration-200 text-gray-700 placeholder-gray-500 resize-none"
                            placeholder="Jelaskan detail event yang akan dibuat">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Reward -->
                <div>
                    <label for="reward" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-gift text-[#8D0907] mr-2"></i>
                        Reward (Rp)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-gift text-gray-400"></i>
                        </div>
                        <input type="number" id="reward" name="reward"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-all duration-200 text-gray-700 placeholder-gray-500"
                            placeholder="0" min="0" required value="{{ old('reward') }}">
                    </div>
                    @error('reward')
                        <p class="text-red-600 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tanggal & Waktu -->
                <div>
                    <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-clock text-[#8D0907] mr-2"></i>
                        Tanggal & Waktu Event
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-clock text-gray-400"></i>
                        </div>
                        <input type="datetime-local" id="date" name="date"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-all duration-200 text-gray-700"
                            required value="{{ old('date') }}">
                    </div>
                    @error('date')
                        <p class="text-red-600 text-sm mt-2 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit"
                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] hover:from-[#B91C1C] hover:to-[#8D0907] text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Event
                    </button>

                    <a href="{{ route('events.index') }}"
                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
