<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Project') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('project.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                                Projects
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Add New Project</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('project.store') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Basic Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name *</label>
                                    <input type="text" name="project_name" id="project_name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter project name">
                                </div>
                                
                                <div>
                                    <label for="project_code" class="block text-sm font-medium text-gray-700">Project Code</label>
                                    <input type="text" name="project_code" id="project_code" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="PRJ-001">
                                </div>
                                
                                <div>
                                    <label for="client_id" class="block text-sm font-medium text-gray-700">Client *</label>
                                    <select name="client_id" id="client_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select client</option>
                                        <option value="1">PT Maju Bersama</option>
                                        <option value="2">Pemda Jakarta</option>
                                        <option value="3">Bank Indonesia</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                    <select name="status" id="status" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select status</option>
                                        <option value="planning">Planning</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                        <option value="on_hold">On Hold</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="priority" class="block text-sm font-medium text-gray-700">Priority *</label>
                                    <select name="priority" id="priority" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select priority</option>
                                        <option value="low">Low</option>
                                        <option value="medium" selected>Medium</option>
                                        <option value="high">High</option>
                                        <option value="urgent">Urgent</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                    <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select category</option>
                                        <option value="web_development">Web Development</option>
                                        <option value="mobile_app">Mobile App</option>
                                        <option value="software_development">Software Development</option>
                                        <option value="consulting">Consulting</option>
                                        <option value="training">Training</option>
                                        <option value="maintenance">Maintenance</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Project Details -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Project Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description *</label>
                                    <textarea name="description" id="description" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter project description"></textarea>
                                </div>
                                
                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date *</label>
                                    <input type="date" name="start_date" id="start_date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                </div>
                                
                                <div>
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date *</label>
                                    <input type="date" name="end_date" id="end_date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                </div>
                                
                                <div>
                                    <label for="estimated_hours" class="block text-sm font-medium text-gray-700">Estimated Hours</label>
                                    <input type="number" name="estimated_hours" id="estimated_hours" min="1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="e.g., 160">
                                </div>
                                
                                <div>
                                    <label for="budget" class="block text-sm font-medium text-gray-700">Budget</label>
                                    <input type="number" name="budget" id="budget" min="0" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="e.g., 50000">
                                </div>
                            </div>
                        </div>

                        <!-- Team & Resources -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Team & Resources</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="project_manager" class="block text-sm font-medium text-gray-700">Project Manager *</label>
                                    <select name="project_manager" id="project_manager" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select project manager</option>
                                        <option value="1">John Doe</option>
                                        <option value="2">Jane Smith</option>
                                        <option value="3">Mike Johnson</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="team_size" class="block text-sm font-medium text-gray-700">Team Size</label>
                                    <input type="number" name="team_size" id="team_size" min="1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="e.g., 5">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="team_members" class="block text-sm font-medium text-gray-700">Team Members</label>
                                    <textarea name="team_members" id="team_members" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter team member names or IDs"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Requirements -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Technical Requirements</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="technology_stack" class="block text-sm font-medium text-gray-700">Technology Stack</label>
                                    <input type="text" name="technology_stack" id="technology_stack" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="e.g., Laravel, Vue.js, MySQL">
                                </div>
                                
                                <div>
                                    <label for="platform" class="block text-sm font-medium text-gray-700">Platform</label>
                                    <select name="platform" id="platform" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select platform</option>
                                        <option value="web">Web</option>
                                        <option value="mobile_ios">Mobile iOS</option>
                                        <option value="mobile_android">Mobile Android</option>
                                        <option value="desktop">Desktop</option>
                                        <option value="cross_platform">Cross Platform</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="technical_requirements" class="block text-sm font-medium text-gray-700">Technical Requirements</label>
                                    <textarea name="technical_requirements" id="technical_requirements" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter technical requirements and specifications"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Deliverables -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Deliverables</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="deliverables" class="block text-sm font-medium text-gray-700">Project Deliverables</label>
                                    <textarea name="deliverables" id="deliverables" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter project deliverables, milestones, and expected outcomes"></textarea>
                                </div>
                                
                                <div>
                                    <label for="success_criteria" class="block text-sm font-medium text-gray-700">Success Criteria</label>
                                    <textarea name="success_criteria" id="success_criteria" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter project success criteria"></textarea>
                                </div>
                                
                                <div>
                                    <label for="risks" class="block text-sm font-medium text-gray-700">Potential Risks</label>
                                    <textarea name="risks" id="risks" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter potential risks and mitigation strategies"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('project.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#8D0907] hover:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Create Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 