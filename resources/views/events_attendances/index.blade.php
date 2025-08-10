<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Event Attendances</h2>
    </x-slot>

    <div class="py-6">
        <a href="{{ route('event-attendances.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">+ Add Attendance</a>
        <table class="w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Employee</th>
                    <th class="border px-4 py-2">Event</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                        <td class="border px-4 py-2">{{ $attendance->employee->name }}</td>
                        <td class="border px-4 py-2">{{ $attendance->event->title }}</td>
                        <td class="border px-4 py-2">{{ $attendance->status }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('event-attendances.edit', $attendance) }}" class="text-blue-500">Edit</a> |
                            <form action="{{ route('event-attendances.destroy', $attendance) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Delete this attendance?')" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
