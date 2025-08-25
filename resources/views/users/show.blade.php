<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail User
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-700">
                    <i class="fas fa-user mr-2 text-[#8D0907]"></i> {{ $user->name }}
                </h3>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                <p><strong>Dibuat pada:</strong> {{ $user->created_at->format('d M Y H:i') }}</p>

                <div class="mt-6">
                    <a href="{{ route('users.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-[#8D0907] hover:bg-[#B91C1C] text-white rounded-lg shadow">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
