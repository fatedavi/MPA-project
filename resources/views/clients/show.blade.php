<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Client Details') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('client.edit', $client['id']) }}" class="inline-flex items-center px-4 py-2 bg-[#8D0907] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#B91C1C] focus:bg-[#B91C1C] active:bg-[#8D0907] focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Client
                </a>
                <a href="{{ route('client.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Client Info Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 h-20 w-20">
                            <div class="h-20 w-20 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-2xl">
                                {{ substr($client['company_name'], 0, 2) }}
                            </div>
                        </div>
                        <div class="ml-6">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $client['company_name'] }}</h1>
                            <p class="text-lg text-gray-600">Client ID: {{ $client['client_code'] }}</p>
                            <div class="flex items-center mt-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    @if($client['status'] === 'active') bg-green-100 text-green-800
                                    @elseif($client['status'] === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($client['status']) }}
                                </span>
                                <span class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $client['category'] }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Contact Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Contact Person</label>
                                    <p class="text-sm text-gray-900">{{ $client['contact_person'] }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Position</label>
                                    <p class="text-sm text-gray-900">{{ $client['position'] }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Email</label>
                                    <p class="text-sm text-gray-900">{{ $client['email'] }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Phone</label>
                                    <p class="text-sm text-gray-900">{{ $client['phone'] }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Website</label>
                                    <p class="text-sm text-gray-900">
                                        <a href="{{ $client['website'] }}" target="_blank" class="text-[#8D0907] hover:text-[#B91C1C]">
                                            {{ $client['website'] }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Address Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Address</label>
                                    <p class="text-sm text-gray-900">{{ $client['address'] }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">City</label>
                                    <p class="text-sm text-gray-900">{{ $client['city'] }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">State/Province</label>
                                    <p class="text-sm text-gray-900">{{ $client['state'] }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Country</label>
                                    <p class="text-sm text-gray-900">{{ $client['country'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects Summary -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Projects Summary</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-blue-600">Total Projects</p>
                                    <p class="text-2xl font-semibold text-blue-900">12</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-600">Active Projects</p>
                                    <p class="text-2xl font-semibold text-green-900">8</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-yellow-600">Pending</p>
                                    <p class="text-2xl font-semibold text-yellow-900">3</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-purple-600">Completed</p>
                                    <p class="text-2xl font-semibold text-purple-900">1</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activities</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">New project "MPA System Development" created</p>
                                <p class="text-sm text-gray-500">2 hours ago</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">Client profile updated</p>
                                <p class="text-sm text-gray-500">1 day ago</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">Invoice INV-001 sent</p>
                                <p class="text-sm text-gray-500">3 days ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 