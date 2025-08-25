<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right w-6 h-6 text-gray-400"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">User Management</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Users -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-400 rounded-full">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-blue-100 text-sm font-medium">Total Users</p>
                            <p class="text-2xl font-bold">{{ $totalUsers }}</p>
                            <p class="text-xs text-blue-200">Semua pengguna</p>
                        </div>
                    </div>
                </div>

                <!-- Admin Users -->
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-400 rounded-full">
                            <i class="fas fa-user-shield text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-purple-100 text-sm font-medium">Admin Users</p>
                            <p class="text-2xl font-bold">{{ $adminUsers }}</p>
                            <p class="text-xs text-purple-200">Administrator</p>
                        </div>
                    </div>
                </div>

                <!-- Super Admin Users -->
                <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-400 rounded-full">
                            <i class="fas fa-crown text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-red-100 text-sm font-medium">Super Admin</p>
                            <p class="text-2xl font-bold">{{ $superAdminUsers }}</p>
                            <p class="text-xs text-red-200">Super Administrator</p>
                        </div>
                    </div>
                </div>

                <!-- Karyawan Users -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-400 rounded-full">
                            <i class="fas fa-user-tie text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-100 text-sm font-medium">Karyawan</p>
                            <p class="text-2xl font-bold">{{ $karyawanUsers }}</p>
                            <p class="text-xs text-green-200">Staff & Karyawan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-search text-[#8D0907]"></i>
                        Search & Filters
                    </h3>
                </div>
                <div class="p-6">
                    <form method="GET" action="{{ route('users.index') }}">
                        <div
                            class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">

                            <!-- Search -->
                            <div class="flex-1 max-w-md">
                                <label for="search" class="sr-only">Search users</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors"
                                        placeholder="Search users...">
                                </div>
                            </div>

                            <!-- Filters -->
                            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                                <select name="role"
                                    class="block w-full sm:w-auto border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#8D0907] focus:border-[#8D0907] transition-colors">
                                    <option value="">All Roles</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="super_admin"
                                        {{ request('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                    <option value="karyawan" {{ request('role') == 'karyawan' ? 'selected' : '' }}>
                                        Karyawan</option>
                                </select>

                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-[#8D0907] hover:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                    <i class="fas fa-filter mr-2"></i>
                                    Filter
                                </button>

                                <a href="{{ route('users.create') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add User
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Users Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-users-cog text-[#8D0907]"></i>
                            Daftar Users
                        </h3>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Total: {{ $users->total() }} users
                            </span>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-user mr-2"></i>User
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-user-tag mr-2"></i>Role
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-calendar-alt mr-2"></i>Tanggal Dibuat
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2"></i>Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-full flex items-center justify-center text-white font-semibold text-lg">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $roleColors = [
                                                'admin' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                'super_admin' => 'bg-purple-100 text-purple-800 border-purple-200',
                                                'karyawan' => 'bg-green-100 text-green-800 border-green-200',
                                            ];
                                            $roleColor =
                                                $roleColors[$user->role ?? 'default'] ??
                                                'bg-gray-100 text-gray-800 border-gray-200';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium border {{ $roleColor }}">
                                            <i class="fas fa-user-tag mr-1.5"></i>
                                            {{ ucfirst($user->role ?? '-') }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <i class="fas fa-calendar-day mr-1 text-[#8D0907]"></i>
                                            {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $user->created_at ? $user->created_at->diffForHumans() : '-' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <!-- Detail -->
                                            {{-- <a href="{{ route('users.show', $user->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-sm transition-colors"
                                                title="Detail">
                                                <i class="fas fa-eye text-sm"></i>
                                            </a> --}}

                                            <!-- Edit -->
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-sm transition-colors"
                                                title="Edit">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>

                                            <!-- Hapus -->
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus user ini?')"
                                                    class="inline-flex items-center justify-center w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-sm transition-colors"
                                                    title="Hapus">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center text-gray-500">
                                            <i class="fas fa-users text-4xl mb-3 text-gray-300"></i>
                                            <p class="text-lg font-medium">Belum ada data users</p>
                                            <p class="text-sm">Data users akan muncul di sini</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if ($users->hasPages())
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
