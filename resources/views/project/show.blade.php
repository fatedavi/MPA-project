<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Project Details') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('project.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Projects
                </a>
                <a href="{{ route('project.edit', $project['id']) }}" class="inline-flex items-center px-4 py-2 bg-[#8D0907] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#B91C1C] focus:bg-[#B91C1C] active:bg-[#8D0907] focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Project
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Project Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-16 w-16">
                            <div class="h-16 w-16 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold text-xl">
                                {{ substr($project['project_name'], 0, 3) }}
                            </div>
                        </div>
                        <div class="ml-6">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $project['project_name'] }}</h1>
                            <p class="text-lg text-gray-600">Project ID: {{ $project['project_code'] }}</p>
                            <div class="flex items-center mt-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($project['status'] === 'completed') bg-purple-100 text-purple-800
                                    @elseif($project['status'] === 'in_progress') bg-green-100 text-green-800
                                    @elseif($project['status'] === 'planning') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $project['status'])) }}
                                </span>
                                <span class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($project['priority'] === 'high') bg-red-100 text-red-800
                                    @elseif($project['priority'] === 'medium') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst($project['priority']) }} Priority
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Details Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Information -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Project Description -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Project Description</h3>
                            <p class="text-gray-600">{{ $project['description'] ?? 'No description available.' }}</p>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Timeline</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Start Date</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ date('F j, Y', strtotime($project['start_date'])) }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">End Date</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ date('F j, Y', strtotime($project['end_date'])) }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Duration</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @php
                                            $startDate = \Carbon\Carbon::parse($project['start_date']);
                                            $endDate = \Carbon\Carbon::parse($project['end_date']);
                                            $duration = $startDate->diffInDays($endDate);
                                            echo $duration . ' days';
                                        @endphp
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Time Remaining</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @php
                                            $endDate = \Carbon\Carbon::parse($project['end_date']);
                                            $now = \Carbon\Carbon::now();
                                            if ($endDate->isPast()) {
                                                echo '<span class="text-green-600">Completed</span>';
                                            } else {
                                                $diff = $now->diffInMonths($endDate);
                                                if ($diff > 0) {
                                                    echo $diff . ' month' . ($diff > 1 ? 's' : '') . ' left';
                                                } else {
                                                    echo $now->diffInDays($endDate) . ' day' . ($now->diffInDays($endDate) > 1 ? 's' : '') . ' left';
                                                }
                                            }
                                        @endphp
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Progress</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between text-sm font-medium text-gray-700 mb-2">
                                        <span>Overall Progress</span>
                                        <span>{{ $project['progress'] }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-green-500 h-3 rounded-full transition-all duration-300" style="width: {{ $project['progress'] }}%"></div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Budget</label>
                                        <p class="mt-1 text-sm text-gray-900">${{ number_format($project['budget'] ?? 0) }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Estimated Hours</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ number_format($project['estimated_hours'] ?? 0) }} hours</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Client Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Client Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Client Name</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $project['client_name'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <a href="{{ route('project.edit', $project['id']) }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-[#8D0907] border border-transparent rounded-md font-semibold text-sm text-white hover:bg-[#B91C1C] focus:bg-[#B91C1C] active:bg-[#8D0907] focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit Project
                                </a>
                                <form method="POST" action="{{ route('project.destroy', $project['id']) }}" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-red-700 focus:bg-red-700 active:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 transition ease-in-out duration-150" onclick="return confirm('Are you sure you want to delete this project?')">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete Project
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 