<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add Employee</h2>
    </x-slot>

    <div class="py-6">
        <form action="{{ route('employees.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label>Name</label>
                <input type="text" name="name" class="border rounded w-full" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" class="border rounded w-full" required>
            </div>
            <button class="px-4 py-2 bg-green-500 text-white rounded">Save</button>
        </form>
    </div>
</x-app-layout>
