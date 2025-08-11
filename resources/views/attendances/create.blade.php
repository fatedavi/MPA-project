<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Check In Attendance</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            <form action="{{ route('attendances.store') }}" method="POST">
                @csrf
                <p>Click button below to check in now.</p>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Check In</button>
            </form>

        </div>
    </div>
</x-app-layout>
