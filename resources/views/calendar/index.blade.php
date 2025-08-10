<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project Calendar') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Calendar Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                        <div class="flex items-center space-x-4">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907]">
                                <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Previous
                            </button>
                            
                            <h3 class="text-lg font-medium text-gray-900">December 2024</h3>
                            
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907]">
                                Next
                                <svg class="-mr-0.5 ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="flex space-x-3">
                            <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#8D0907] hover:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add Event
                            </button>
                            
                            <select name="view" class="block border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                <option value="month">Month</option>
                                <option value="week">Week</option>
                                <option value="day">Day</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Calendar Header -->
                    <div class="grid grid-cols-7 gap-px bg-gray-200 border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-gray-50 py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sun
                        </div>
                        <div class="bg-gray-50 py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Mon
                        </div>
                        <div class="bg-gray-50 py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tue
                        </div>
                        <div class="bg-gray-50 py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Wed
                        </div>
                        <div class="bg-gray-50 py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thu
                        </div>
                        <div class="bg-gray-50 py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fri
                        </div>
                        <div class="bg-gray-50 py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sat
                        </div>
                    </div>

                    <!-- Calendar Days -->
                    <div class="grid grid-cols-7 gap-px bg-gray-200 border border-gray-200 rounded-lg overflow-hidden">
                        <!-- Previous Month Days -->
                        <div class="bg-white min-h-[120px] p-2 text-sm text-gray-400">
                            <div class="text-right">26</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm text-gray-400">
                            <div class="text-right">27</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm text-gray-400">
                            <div class="text-right">28</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm text-gray-400">
                            <div class="text-right">29</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm text-gray-400">
                            <div class="text-right">30</div>
                        </div>

                        <!-- Current Month Days -->
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">1</div>
                            <div class="mt-1">
                                <div class="text-xs bg-blue-100 text-blue-800 rounded px-1 py-1 mb-1 truncate">
                                    Project Kickoff
                                </div>
                                <div class="text-xs bg-green-100 text-green-800 rounded px-1 py-1 truncate">
                                    Team Meeting
                                </div>
                            </div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">2</div>
                            <div class="mt-1">
                                <div class="text-xs bg-yellow-100 text-yellow-800 rounded px-1 py-1 truncate">
                                    Design Review
                                </div>
                            </div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">3</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">4</div>
                            <div class="mt-1">
                                <div class="text-xs bg-purple-100 text-purple-800 rounded px-1 py-1 truncate">
                                    Client Meeting
                                </div>
                            </div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">5</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">6</div>
                            <div class="mt-1">
                                <div class="text-xs bg-red-100 text-red-800 rounded px-1 py-1 truncate">
                                    Deadline
                                </div>
                            </div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">7</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">8</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">9</div>
                            <div class="mt-1">
                                <div class="text-xs bg-blue-100 text-blue-800 rounded px-1 py-1 truncate">
                                    Sprint Planning
                                </div>
                            </div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">10</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">11</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">12</div>
                            <div class="mt-1">
                                <div class="text-xs bg-orange-100 text-orange-800 rounded px-1 py-1 truncate">
                                    Code Review
                                </div>
                            </div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">13</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">14</div>
                            <div class="mt-1">
                                <div class="text-xs bg-green-100 text-green-800 rounded px-1 py-1 truncate">
                                    Testing
                                </div>
                            </div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">15</div>
                            <div class="mt-1">
                                <div class="text-xs bg-blue-100 text-blue-800 rounded px-1 py-1 truncate">
                                    Project Demo
                                </div>
                            </div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">16</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">17</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">18</div>
                            <div class="mt-1">
                                <div class="text-xs bg-purple-100 text-purple-800 rounded px-1 py-1 truncate">
                                    Stakeholder Review
                                </div>
                            </div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">19</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">20</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">21</div>
                            <div class="mt-1">
                                <div class="text-xs bg-yellow-100 text-yellow-800 rounded px-1 py-1 truncate">
                                    Final Testing
                                </div>
                            </div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">22</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">23</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">24</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">25</div>
                            <div class="mt-1">
                                <div class="text-xs bg-green-100 text-green-800 rounded px-1 py-1 truncate">
                                    Project Launch
                                </div>
                            </div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">26</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">27</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">28</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">29</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">30</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm">
                            <div class="text-right font-medium text-gray-900">31</div>
                        </div>

                        <!-- Next Month Days -->
                        <div class="bg-white min-h-[120px] p-2 text-sm text-gray-400">
                            <div class="text-right">1</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm text-gray-400">
                            <div class="text-right">2</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm text-gray-400">
                            <div class="text-right">3</div>
                        </div>
                        <div class="bg-white min-h-[120px] p-2 text-sm text-gray-400">
                            <div class="text-right">4</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Upcoming Events</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full mt-2"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Project Kickoff Meeting</p>
                                    <p class="text-sm text-gray-500">Mobile App Development</p>
                                    <p class="text-xs text-gray-400">Dec 1, 2024 • 9:00 AM</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mt-2"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Design Review Session</p>
                                    <p class="text-sm text-gray-500">UI/UX Design</p>
                                    <p class="text-xs text-gray-400">Dec 2, 2024 • 2:00 PM</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-3 h-3 bg-purple-500 rounded-full mt-2"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Client Presentation</p>
                                    <p class="text-sm text-gray-500">E-commerce Platform</p>
                                    <p class="text-xs text-gray-400">Dec 4, 2024 • 10:00 AM</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-3 h-3 bg-red-500 rounded-full mt-2"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Project Deadline</p>
                                    <p class="text-sm text-gray-500">Payment System</p>
                                    <p class="text-xs text-gray-400">Dec 6, 2024 • 5:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Project Timeline</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-900">Mobile App Development</span>
                                    <span class="text-sm text-gray-500">75%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Due: Dec 25, 2024</p>
                            </div>
                            
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-900">E-commerce Platform</span>
                                    <span class="text-sm text-gray-500">90%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: 90%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Due: Dec 20, 2024</p>
                            </div>
                            
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-900">Payment System</span>
                                    <span class="text-sm text-gray-500">60%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-600 h-2 rounded-full" style="width: 60%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Due: Dec 30, 2024</p>
                            </div>
                            
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-900">Analytics Dashboard</span>
                                    <span class="text-sm text-gray-500">45%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-600 h-2 rounded-full" style="width: 45%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Due: Jan 15, 2025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 