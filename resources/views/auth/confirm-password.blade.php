<x-guest-layout>
    <div class="text-center mb-8">
        <div class="flex items-center justify-center mb-4">
            <div class="w-12 h-12 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-bolt text-2xl text-white"></i>
            </div>
            <span class="text-2xl font-bold text-gray-900 ml-3">EPower</span>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Confirm Password</h1>
        <p class="text-gray-600">This is a secure area of the application</p>
    </div>

    <div class="mb-6 text-sm text-gray-600 bg-gray-50 border border-gray-200 rounded-lg p-4">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
            <div class="mt-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <x-text-input id="password" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-[#B91C1C] hover:to-[#8D0907] focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
