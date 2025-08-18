<x-guest-layout>
    <div class="w-full max-w-md relative overflow-hidden">
        <!-- Slider Container -->
        <div id="form-slider" class="flex transition-transform duration-500 ease-in-out">
            <!-- Login Form -->
            <div class="w-full flex-shrink-0 px-6 py-4">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome back</h2>
                    <p class="text-gray-600">Sign in to your account</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-red-600 hover:text-red-800">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-200">
                        Sign in
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">Don't have an account? 
                        <button onclick="slideToRegister()" class="text-red-600 font-medium hover:text-red-800">Sign up</button>
                    </p>
                </div>
            </div>

            <!-- Register Form -->
            <div class="w-full flex-shrink-0 px-6 py-4">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Create account</h2>
                    <p class="text-gray-600">Join us today</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    </div>

                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition duration-200">
                        Register
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">Already have an account? 
                        <button onclick="slideToLogin()" class="text-red-600 font-medium hover:text-red-800">Sign in</button>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Animation styles */
        @keyframes slideInFromLeft {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slideInFromRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        .slide-in-left {
            animation: slideInFromLeft 0.5s ease-out forwards;
        }
        
        .slide-in-right {
            animation: slideInFromRight 0.5s ease-out forwards;
        }
    </style>

    <script>
        function slideToRegister() {
            const slider = document.getElementById('form-slider');
            slider.style.transform = 'translateX(-100%)';
        }

        function slideToLogin() {
            const slider = document.getElementById('form-slider');
            slider.style.transform = 'translateX(0)';
        }

        // Add touch swipe support
        let touchStartX = 0;
        let touchEndX = 0;
        const sliderContainer = document.querySelector('.overflow-hidden');

        sliderContainer.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, false);

        sliderContainer.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, false);

        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                // Swipe left
                slideToRegister();
            } else if (touchEndX > touchStartX + 50) {
                // Swipe right
                slideToLogin();
            }
        }
    </script>
</x-guest-layout>