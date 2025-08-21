<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajukan Cuti') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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
                            <a href="{{ route('cuti.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-[#8D0907] md:ml-2">
                                Cuti
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right w-6 h-6 text-gray-400"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Ajukan Cuti</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Main Form -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-calendar-plus text-[#8D0907]"></i>
                            Form Pengajuan Cuti
                        </h3>
                    </div>
                </div>

                <div class="p-6">
                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center">
                            <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-exclamation-triangle mr-2 text-red-500"></i>
                                <span class="font-medium">Terdapat kesalahan pada form:</span>
                            </div>
                            <ul class="list-disc list-inside ml-6">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('cuti.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Tanggal Cuti -->
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar mr-2 text-[#8D0907]"></i>
                                Tanggal Cuti
                            </label>
                            <input type="date" 
                                   name="tanggal" 
                                   id="tanggal"
                                   value="{{ old('tanggal') }}"
                                   class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors" 
                                   required>
                            <p class="mt-1 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Pilih tanggal mulai cuti Anda
                            </p>
                        </div>

                        <!-- Jumlah Hari -->
                        <div>
                            <label for="day" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-clock mr-2 text-[#8D0907]"></i>
                                Jumlah Hari
                            </label>
                            <input type="number" 
                                   name="day" 
                                   id="day" 
                                   min="1" 
                                   max="30"
                                   value="{{ old('day') }}"
                                   class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors" 
                                   required>
                            <p class="mt-1 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Masukkan jumlah hari cuti (maksimal 30 hari)
                            </p>
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-file-alt mr-2 text-[#8D0907]"></i>
                                Keterangan
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="4"
                                      placeholder="Masukkan alasan atau keterangan cuti..."
                                      class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors resize-none">{{ old('description') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan alasan atau keperluan cuti Anda (opsional)
                            </p>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                                <div class="text-sm text-blue-800">
                                    <p class="font-medium mb-1">Informasi Penting:</p>
                                    <ul class="list-disc list-inside space-y-1 text-xs">
                                        <li>Pengajuan cuti akan diproses dalam 1-2 hari kerja</li>
                                        <li>Pastikan tanggal dan jumlah hari cuti sudah benar</li>
                                        <li>Pengajuan dapat dibatalkan sebelum disetujui</li>
                                        <li>Pastikan pengajuan cuti Anda sesuai dengan kebijakan perusahaan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <a href="{{ route('cuti.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors shadow-md hover:shadow-lg">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 bg-[#8D0907] text-white rounded-lg hover:bg-[#6B0705] transition-colors shadow-md hover:shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Ajukan Cuti
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>