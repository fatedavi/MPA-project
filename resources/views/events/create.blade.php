<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Event Baru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-700">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right w-6 h-6 text-gray-400"></i>
                            <a href="{{ route('events.index') }}"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-red-700 md:ml-2">Event
                                Management</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right w-6 h-6 text-gray-400"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Tambah Event</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header Section -->
            <div class="mb-6 text-center">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Buat Event Baru</h1>
                <p class="text-gray-600 text-base md:text-lg">Isi informasi event yang akan dibuat</p>
            </div>

            <!-- Main Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-plus-circle text-red-700"></i>
                        Form Event
                    </h3>
                </div>

                <form action="{{ route('events.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <!-- Nama Event -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar text-red-700 mr-2"></i>
                            Nama Event
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar text-gray-400"></i>
                            </div>
                            <input type="text" id="name" name="name"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-700 focus:border-red-700 transition-all duration-200 text-gray-700 placeholder-gray-500"
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
                            <i class="fas fa-align-left text-red-700 mr-2"></i>
                            Deskripsi Event
                        </label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                <i class="fas fa-align-left text-gray-400"></i>
                            </div>
                            <textarea id="description" name="description" rows="4"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-700 focus:border-red-700 transition-all duration-200 text-gray-700 placeholder-gray-500 resize-none"
                                placeholder="Jelaskan detail event yang akan dibuat">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Reward -->
                    <div>
                        <label for="reward" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-gift text-red-700 mr-2"></i>
                            Reward (Rp)
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 font-medium">Rp</span>
                            </div>
                            <input type="number" id="reward" name="reward"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-700 focus:border-red-700 transition-all duration-200 text-gray-700 placeholder-gray-500"
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
                            <i class="fas fa-clock text-red-700 mr-2"></i>
                            Tanggal & Waktu Event
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-clock text-gray-400"></i>
                            </div>
                            <input type="datetime-local" id="date" name="date"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-700 focus:border-red-700 transition-all duration-200 text-gray-700"
                                required value="{{ old('date') }}">
                        </div>
                        @error('date')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Status (Optional) -->
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-info-circle text-red-700 mr-2"></i>
                            Status Event
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-info-circle text-gray-400"></i>
                            </div>
                            <select id="status" name="status"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-700 focus:border-red-700 transition-all duration-200 text-gray-700">
                                <option value="coming_soon"
                                    {{ old('status', 'coming_soon') == 'coming_soon' ? 'selected' : '' }}>Coming Soon
                                </option>
                                <option value="approve" {{ old('status') == 'approve' ? 'selected' : '' }}>Disetujui
                                </option>
                                <option value="reject" {{ old('status') == 'reject' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>
                        @error('status')
                            <p class="text-red-600 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit"
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-red-700 hover:bg-red-800 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Event
                        </button>

                        <a href="{{ route('events.index') }}"
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>

            <!-- Form Helper Info -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">
                            Informasi Penting
                        </h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <ul class="list-disc pl-5 space-y-1">
                                <li>Pastikan nama event sudah sesuai dan mudah dipahami</li>
                                <li>Deskripsi event sebaiknya menjelaskan detail kegiatan yang akan dilakukan</li>
                                <li>Reward dalam format Rupiah (tanpa titik atau koma)</li>
                                <li>Tanggal dan waktu event harus akurat sesuai rencana pelaksanaan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
