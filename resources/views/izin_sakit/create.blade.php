<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajukan Izin Sakit') }}
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
                            <a href="{{ route('izin-sakit.index') }}" 
                               class="ml-1 text-sm font-medium text-gray-700 hover:text-[#8D0907] md:ml-2">
                                Izin Sakit
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right w-6 h-6 text-gray-400"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Ajukan Izin Sakit</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Main Form -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-notes-medical text-[#8D0907]"></i>
                            Form Pengajuan Izin Sakit
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

                    <form action="{{ route('izin-sakit.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <!-- Alasan -->
                        <div>
                            <label for="alasan" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-file-alt mr-2 text-[#8D0907]"></i>
                                Alasan Sakit (Opsional)
                            </label>
                            <textarea name="alasan" 
                                      id="alasan" 
                                      rows="4"
                                      placeholder="Tuliskan gejala atau alasan sakit Anda..."
                                      class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors resize-none">{{ old('alasan') }}</textarea>
                        </div>

                        <!-- Upload Surat Dokter -->
                        <div>
                            <label for="dokter_surat" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-file-medical mr-2 text-[#8D0907]"></i>
                                Upload Surat Dokter <span class="text-red-500">*</span>
                            </label>
                            <input type="file" 
                                   name="dokter_surat" 
                                   id="dokter_surat"
                                   accept=".pdf,.jpg,.jpeg,.png"
                                   class="mt-1 block w-full text-sm text-gray-600 border border-gray-300 rounded-lg shadow-sm cursor-pointer focus:ring-[#8D0907] focus:border-[#8D0907]"
                                   required>
                            <p class="mt-1 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Format file: PDF, JPG, JPEG, atau PNG. Maksimal 2MB.
                            </p>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                                <div class="text-sm text-blue-800">
                                    <p class="font-medium mb-1">Informasi Penting:</p>
                                    <ul class="list-disc list-inside space-y-1 text-xs">
                                        <li>Pengajuan izin sakit harus menyertakan surat dokter resmi</li>
                                        <li>Status izin akan diverifikasi oleh HR/Admin</li>
                                        <li>Anda akan mendapat notifikasi jika izin disetujui atau ditolak</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                            <a href="{{ route('izin-sakit.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors shadow-md hover:shadow-lg">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 bg-[#8D0907] text-white rounded-lg hover:bg-[#6B0705] transition-colors shadow-md hover:shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Ajukan Izin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
