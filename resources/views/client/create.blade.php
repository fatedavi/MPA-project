<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Client') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('client.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                                Clients
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Add New Client</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('client.store') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Basic Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name *</label>
                                    <input type="text" name="company_name" id="company_name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter company name">
                                </div>
                                
                                <div>
                                    <label for="client_code" class="block text-sm font-medium text-gray-700">Client Code</label>
                                    <input type="text" name="client_code" id="client_code" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="CLI-001">
                                </div>
                                
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700">Category *</label>
                                    <select name="category" id="category" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select category</option>
                                        <option value="Technology">Technology</option>
                                        <option value="Finance">Finance</option>
                                        <option value="Healthcare">Healthcare</option>
                                        <option value="Education">Education</option>
                                        <option value="Government">Government</option>
                                        <option value="Retail">Retail</option>
                                        <option value="Manufacturing">Manufacturing</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                    <select name="status" id="status" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="prospect">Prospect</option>
                                        <option value="suspended">Suspended</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact Person *</label>
                                    <input type="text" name="contact_person" id="contact_person" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter contact person name">
                                </div>
                                
                                <div>
                                    <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                                    <input type="text" name="position" id="position" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="e.g., Project Manager">
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                                    <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="contact@company.com">
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone *</label>
                                    <input type="tel" name="phone" id="phone" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="+62 812-3456-7890">
                                </div>
                                
                                <div>
                                    <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                                    <input type="url" name="website" id="website" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="https://www.company.com">
                                </div>
                                
                                <div>
                                    <label for="social_media" class="block text-sm font-medium text-gray-700">Social Media</label>
                                    <input type="text" name="social_media" id="social_media" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="LinkedIn, Twitter, etc.">
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Address Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address *</label>
                                    <textarea name="address" id="address" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter full address"></textarea>
                                </div>
                                
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700">City *</label>
                                    <input type="text" name="city" id="city" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter city">
                                </div>
                                
                                <div>
                                    <label for="state" class="block text-sm font-medium text-gray-700">State/Province *</label>
                                    <input type="text" name="state" id="state" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter state or province">
                                </div>
                                
                                <div>
                                    <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                                    <input type="text" name="postal_code" id="postal_code" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter postal code">
                                </div>
                                
                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700">Country *</label>
                                    <select name="country" id="country" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select country</option>
                                        <option value="Indonesia" selected>Indonesia</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Company Details -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Company Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                                    <input type="text" name="industry" id="industry" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="e.g., Software Development">
                                </div>
                                
                                <div>
                                    <label for="company_size" class="block text-sm font-medium text-gray-700">Company Size</label>
                                    <select name="company_size" id="company_size" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select company size</option>
                                        <option value="1-10">1-10 employees</option>
                                        <option value="11-50">11-50 employees</option>
                                        <option value="51-200">51-200 employees</option>
                                        <option value="201-500">201-500 employees</option>
                                        <option value="501-1000">501-1000 employees</option>
                                        <option value="1000+">1000+ employees</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="annual_revenue" class="block text-sm font-medium text-gray-700">Annual Revenue</label>
                                    <select name="annual_revenue" id="annual_revenue" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select annual revenue</option>
                                        <option value="< 1M">Less than 1M</option>
                                        <option value="1M - 10M">1M - 10M</option>
                                        <option value="10M - 50M">10M - 50M</option>
                                        <option value="50M - 100M">50M - 100M</option>
                                        <option value="100M - 500M">100M - 500M</option>
                                        <option value="500M+">500M+</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="founded_year" class="block text-sm font-medium text-gray-700">Founded Year</label>
                                    <input type="number" name="founded_year" id="founded_year" min="1900" max="2024" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="e.g., 2010">
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="source" class="block text-sm font-medium text-gray-700">Lead Source</label>
                                    <select name="source" id="source" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select lead source</option>
                                        <option value="Website">Website</option>
                                        <option value="Referral">Referral</option>
                                        <option value="Social Media">Social Media</option>
                                        <option value="Cold Call">Cold Call</option>
                                        <option value="Trade Show">Trade Show</option>
                                        <option value="Advertisement">Advertisement</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                                    <select name="priority" id="priority" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select priority</option>
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                        <option value="urgent">Urgent</option>
                                    </select>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Enter additional notes or description about the client"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('client.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#8D0907] hover:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Create Client
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 