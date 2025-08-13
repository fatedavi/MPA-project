<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Event Attendance
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Kehadiran Event</h2>

                    <form action="{{ route('event-attendances.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Pilih Pegawai --}}
                        <div>
                            <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih
                                Pegawai</label>
                            <select name="employee_id[]" id="employee_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2 pl-3 pr-10 border"
                                multiple size="5">
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" class="py-1">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-sm text-gray-500">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Tips
                                </span>
                                <span class="ml-1">Gunakan CTRL/CMD untuk memilih multiple pegawai</span>
                            </p>
                        </div>

                        {{-- Pilih Event --}}
                        <div>
                            <label for="event_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih
                                Event</label>
                            <select name="event_id" id="event_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2 pl-3 pr-10 border">
                                <option value="">-- Pilih Event --</option>
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex justify-between pt-4">
                            <a href="{{ route('event-attendances.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                Kembali
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                Simpan Kehadiran
                            </button>
                        </div>
                    </form>
                </div>
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
