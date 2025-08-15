<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client Management') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                                <i class="fas fa-home mr-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="text-sm font-medium text-gray-500">Client Management</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Clients</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $clients->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-check-circle text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Active Clients</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $clients->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Locations</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $clients->unique('kota')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-handshake text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Partners</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $clients->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6">
                    <!-- Header with Add Button -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                        <div class="mb-4 sm:mb-0">
                            <h3 class="text-2xl font-bold text-gray-900">Client List</h3>
                            <p class="text-sm text-gray-600 mt-1">Manage client information and relationships</p>
                        </div>
                        <div>
                            <a href="{{ route('clients.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:from-[#B91C1C] hover:to-[#8D0907] focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <i class="fas fa-plus mr-2"></i>
                                Add Client
                            </a>
                        </div>
                    </div>

                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center">
                            <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Client Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-hashtag mr-2 text-gray-400"></i>Kode
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-user mr-2 text-gray-400"></i>Nama
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>Alamat
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-user-tie mr-2 text-gray-400"></i>UP
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-file-contract mr-2 text-gray-400"></i>UPSPH
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        <i class="fas fa-cogs mr-2 text-gray-400"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($clients as $client)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $client->id_client }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white text-sm font-semibold">{{ substr($client->nama_client, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $client->nama_client }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $client->alamat_client }}">
                                            {{ $client->alamat_client }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $client->up }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            {{ $client->upsph }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('clients.show', $client->id_client) }}" 
                                               class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                                               title="View Details">
                                                <i class="fas fa-eye mr-1"></i>
                                                View
                                            </a>
                                            <a href="{{ route('clients.edit', $client->id_client) }}" 
                                               class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200"
                                               title="Edit Client">
                                                <i class="fas fa-edit mr-1"></i>
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('clients.destroy', $client->id_client) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                                                        onclick="return confirm('Are you sure you want to delete this client?')" 
                                                        title="Delete Client">
                                                    <i class="fas fa-trash mr-1"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                <i class="fas fa-users text-2xl text-gray-400"></i>
                                            </div>
                                            <h3 class="text-lg font-medium text-gray-900 mb-2">No clients found</h3>
                                            <p class="text-gray-500 mb-4">Get started by creating your first client.</p>
                                            <a href="{{ route('clients.create') }}" class="inline-flex items-center px-4 py-2 bg-[#8D0907] border border-transparent rounded-md font-semibold text-sm text-white hover:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                                <i class="fas fa-plus mr-2"></i>
                                                Add First Client
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($clients->hasPages())
                        <div class="mt-6">
                            {{ $clients->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>