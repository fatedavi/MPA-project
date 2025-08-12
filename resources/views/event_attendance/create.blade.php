<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Event Attendance
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('event-attendances.store') }}" method="POST">
                    @csrf

                    {{-- Pilih Pegawai --}}
                    <div class="mb-4">
                        <label for="employee_id" class="block text-sm font-medium text-gray-700">Pilih Pegawai</label>
                        <select name="employee_id[]" id="employee_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md" multiple>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-sm text-gray-500">Tekan CTRL / CMD untuk memilih lebih dari 1 pegawai</p>
                    </div>

                    {{-- Pilih Event --}}
                    <div class="mb-4">
                        <label for="event_id" class="block text-sm font-medium text-gray-700">Pilih Event</label>
                        <select name="event_id" id="event_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md">
                            <option value="">-- Pilih Event --</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tombol Submit --}}
                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyimpan',
                text: "{{ session('error') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK'
                timer: 2000,
                showConfirmButton: false

            });
        </script>
    @endif

</x-app-layout>
