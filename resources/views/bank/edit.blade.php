<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Bank') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                                <i class="fas fa-home mr-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <a href="{{ route('bank.index') }}" class="text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                                    Bank Management
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="text-sm font-medium text-gray-500">Edit Bank</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('bank.update', $bank) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Bank Information -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <h3 class="text-xl font-semibold text-blue-900 mb-4 flex items-center">
                                <i class="fas fa-university text-blue-600 mr-3 text-xl"></i>
                                Bank Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_bank" class="block text-sm font-medium text-gray-700">Bank Name *</label>
                                    <input type="text" name="nama_bank" id="nama_bank" value="{{ old('nama_bank', $bank->nama_bank) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="e.g., Bank Mandiri, BCA, BNI">
                                    @error('nama_bank')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="an" class="block text-sm font-medium text-gray-700">Account Name *</label>
                                    <input type="text" name="an" id="an" value="{{ old('an', $bank->an) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="e.g., PT. Company Name">
                                    @error('an')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="ac" class="block text-sm font-medium text-gray-700">Account Number *</label>
                                    <input type="text" name="ac" id="ac" value="{{ old('ac', $bank->ac) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm font-mono" placeholder="e.g., 1234567890">
                                    @error('ac')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Enter the bank account number without spaces or special characters</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('bank.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                <i class="fas fa-times mr-2"></i>
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#8D0907] hover:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Update Bank
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
