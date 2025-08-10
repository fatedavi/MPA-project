<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="mb-4">Welcome to the Event Attendance System!</p>

                <div class="flex gap-4">
                    <a href="{{ route('employees.index') }}" 
                       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Manage Employees
                    </a>

                    <a href="{{ route('events.index') }}" 
                       class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Manage Events
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
