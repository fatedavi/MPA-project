<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Project') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('project.show', $project['id']) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    View Project
                </a>
                <a href="{{ route('project.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Projects
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('project.update', $project['id']) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Project Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Project Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="project_name" :value="__('Project Name')" />
                                    <x-text-input id="project_name" name="project_name" type="text" class="mt-1 block w-full" :value="old('project_name', $project['project_name'])" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('project_name')" />
                                </div>
                                
                                <div>
                                    <x-input-label for="project_code" :value="__('Project Code')" />
                                    <x-text-input id="project_code" name="project_code" type="text" class="mt-1 block w-full" :value="old('project_code', $project['project_code'])" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('project_code')" />
                                </div>
                                
                                <div>
                                    <x-input-label for="client_id" :value="__('Client')" />
                                    <select id="client_id" name="client_id" class="mt-1 block w-full border-gray-300 focus:border-[#8D0907] focus:ring-[#8D0907] rounded-md shadow-sm" required>
                                        <option value="">Select Client</option>
                                        <option value="1" {{ $project['client_id'] == 1 ? 'selected' : '' }}>PT Maju Bersama</option>
                                        <option value="2" {{ $project['client_id'] == 2 ? 'selected' : '' }}>Pemda Jakarta</option>
                                        <option value="3" {{ $project['client_id'] == 3 ? 'selected' : '' }}>Bank Indonesia</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
                                </div>
                                
                                <div>
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-[#8D0907] focus:ring-[#8D0907] rounded-md shadow-sm" required>
                                        <option value="planning" {{ $project['status'] == 'planning' ? 'selected' : '' }}>Planning</option>
                                        <option value="in_progress" {{ $project['status'] == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="on_hold" {{ $project['status'] == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                        <option value="completed" {{ $project['status'] == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $project['status'] == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                </div>
                                
                                <div>
                                    <x-input-label for="priority" :value="__('Priority')" />
                                    <select id="priority" name="priority" class="mt-1 block w-full border-gray-300 focus:border-[#8D0907] focus:ring-[#8D0907] rounded-md shadow-sm" required>
                                        <option value="low" {{ $project['priority'] == 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ $project['priority'] == 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="high" {{ $project['priority'] == 'high' ? 'selected' : '' }}>High</option>
                                        <option value="urgent" {{ $project['priority'] == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('priority')" />
                                </div>
                            </div>
                        </div>

                        <!-- Timeline -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Timeline</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="start_date" :value="__('Start Date')" />
                                    <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date', $project['start_date'])" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                                </div>
                                
                                <div>
                                    <x-input-label for="end_date" :value="__('End Date')" />
                                    <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date', $project['end_date'])" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                                </div>
                            </div>
                        </div>

                        <!-- Project Details -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Project Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="budget" :value="__('Budget ($)')" />
                                    <x-text-input id="budget" name="budget" type="number" step="0.01" class="mt-1 block w-full" :value="old('budget', $project['budget'] ?? 0)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('budget')" />
                                </div>
                                
                                <div>
                                    <x-input-label for="estimated_hours" :value="__('Estimated Hours')" />
                                    <x-text-input id="estimated_hours" name="estimated_hours" type="number" class="mt-1 block w-full" :value="old('estimated_hours', $project['estimated_hours'] ?? 0)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('estimated_hours')" />
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-[#8D0907] focus:ring-[#8D0907] rounded-md shadow-sm">{{ old('description', $project['description'] ?? '') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('project.show', $project['id']) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <x-primary-button class="bg-[#8D0907] hover:bg-[#B91C1C] focus:bg-[#B91C1C] active:bg-[#8D0907] focus:ring-[#8D0907]">
                                {{ __('Update Project') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 