<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Settings Navigation -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="border-b border-gray-200 mb-6">
                        <nav class="-mb-px flex space-x-8">
                            <a href="#general" class="border-b-2 border-[#8D0907] py-2 px-1 text-sm font-medium text-[#8D0907]">
                                General
                            </a>
                            <a href="#company" class="border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                Company
                            </a>
                            <a href="#notifications" class="border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                Notifications
                            </a>
                            <a href="#security" class="border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                Security
                            </a>
                            <a href="#integrations" class="border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                Integrations
                            </a>
                        </nav>
                    </div>

                    <!-- General Settings -->
                    <div id="general">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">General Settings</h3>
                        <div class="space-y-6">
                            <!-- System Name -->
                            <div>
                                <label for="system_name" class="block text-sm font-medium text-gray-700">System Name</label>
                                <input type="text" name="system_name" id="system_name" value="MPA - Management Project Application" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                <p class="mt-1 text-sm text-gray-500">Nama sistem yang akan ditampilkan di header dan title</p>
                            </div>

                            <!-- Timezone -->
                            <div>
                                <label for="timezone" class="block text-sm font-medium text-gray-700">Timezone</label>
                                <select name="timezone" id="timezone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                    <option value="Asia/Jakarta" selected>Asia/Jakarta (WIB)</option>
                                    <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                                    <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                                    <option value="UTC">UTC</option>
                                </select>
                                <p class="mt-1 text-sm text-gray-500">Timezone default untuk sistem</p>
                            </div>

                            <!-- Date Format -->
                            <div>
                                <label for="date_format" class="block text-sm font-medium text-gray-700">Date Format</label>
                                <select name="date_format" id="date_format" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                    <option value="d/m/Y" selected>DD/MM/YYYY</option>
                                    <option value="Y-m-d">YYYY-MM-DD</option>
                                    <option value="d-m-Y">DD-MM-YYYY</option>
                                    <option value="m/d/Y">MM/DD/YYYY</option>
                                </select>
                                <p class="mt-1 text-sm text-gray-500">Format tanggal yang digunakan di seluruh sistem</p>
                            </div>

                            <!-- Language -->
                            <div>
                                <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
                                <select name="language" id="language" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                    <option value="id" selected>Bahasa Indonesia</option>
                                    <option value="en">English</option>
                                </select>
                                <p class="mt-1 text-sm text-gray-500">Bahasa default untuk sistem</p>
                            </div>

                            <!-- Maintenance Mode -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">Maintenance Mode</h4>
                                    <p class="text-sm text-gray-500">Aktifkan mode maintenance untuk maintenance sistem</p>
                                </div>
                                <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 bg-gray-200" role="switch" aria-checked="false">
                                    <span class="translate-x-0 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Company Settings -->
                    <div id="company" class="hidden mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Company Information</h3>
                        <div class="space-y-6">
                            <!-- Company Name -->
                            <div>
                                <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                                <input type="text" name="company_name" id="company_name" value="PT Maju Bersama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                            </div>

                            <!-- Company Address -->
                            <div>
                                <label for="company_address" class="block text-sm font-medium text-gray-700">Company Address</label>
                                <textarea name="company_address" id="company_address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 12190</textarea>
                            </div>

                            <!-- Company Phone -->
                            <div>
                                <label for="company_phone" class="block text-sm font-medium text-gray-700">Company Phone</label>
                                <input type="text" name="company_phone" id="company_phone" value="+62 21 1234 5678" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                            </div>

                            <!-- Company Email -->
                            <div>
                                <label for="company_email" class="block text-sm font-medium text-gray-700">Company Email</label>
                                <input type="email" name="company_email" id="company_email" value="info@majubersama.com" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                            </div>

                            <!-- Company Website -->
                            <div>
                                <label for="company_website" class="block text-sm font-medium text-gray-700">Company Website</label>
                                <input type="url" name="company_website" id="company_website" value="https://www.majubersama.com" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                            </div>

                            <!-- Company Logo -->
                            <div>
                                <label for="company_logo" class="block text-sm font-medium text-gray-700">Company Logo</label>
                                <div class="mt-1 flex items-center">
                                    <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907]">
                                        Change
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Settings -->
                    <div id="notifications" class="hidden mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Notification Settings</h3>
                        <div class="space-y-6">
                            <!-- Email Notifications -->
                            <div class="space-y-4">
                                <h4 class="text-sm font-medium text-gray-900">Email Notifications</h4>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-700">New Project Assignment</h5>
                                        <p class="text-sm text-gray-500">Notifikasi ketika project baru ditugaskan</p>
                                    </div>
                                    <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 bg-[#8D0907]" role="switch" aria-checked="true">
                                        <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                    </button>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-700">Project Updates</h5>
                                        <p class="text-sm text-gray-500">Notifikasi update status project</p>
                                    </div>
                                    <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 bg-[#8D0907]" role="switch" aria-checked="true">
                                        <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                    </button>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-700">Invoice Reminders</h5>
                                        <p class="text-sm text-gray-500">Reminder untuk invoice yang belum dibayar</p>
                                    </div>
                                    <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 bg-[#8D0907]" role="switch" aria-checked="true">
                                        <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                    </button>
                                </div>
                            </div>

                            <!-- SMS Notifications -->
                            <div class="space-y-4">
                                <h4 class="text-sm font-medium text-gray-900">SMS Notifications</h4>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-700">Critical Alerts</h5>
                                        <p class="text-sm text-gray-500">SMS untuk alert kritis</p>
                                    </div>
                                    <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 bg-gray-200" role="switch" aria-checked="false">
                                        <span class="translate-x-0 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Settings -->
                    <div id="security" class="hidden mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Security Settings</h3>
                        <div class="space-y-6">
                            <!-- Password Policy -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Password Policy</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-700">Minimum Length</span>
                                        <select name="min_password_length" class="border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                            <option value="8" selected>8 characters</option>
                                            <option value="10">10 characters</option>
                                            <option value="12">12 characters</option>
                                        </select>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-700">Require Uppercase</span>
                                        <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 bg-[#8D0907]" role="switch" aria-checked="true">
                                            <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                        </button>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-700">Require Numbers</span>
                                        <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 bg-[#8D0907]" role="switch" aria-checked="true">
                                            <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Session Management -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Session Management</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-700">Session Timeout</span>
                                        <select name="session_timeout" class="border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                            <option value="30">30 minutes</option>
                                            <option value="60" selected>1 hour</option>
                                            <option value="120">2 hours</option>
                                            <option value="480">8 hours</option>
                                        </select>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-700">Force Logout on Inactivity</span>
                                        <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 bg-[#8D0907]" role="switch" aria-checked="true">
                                            <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Two-Factor Authentication -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Two-Factor Authentication</h4>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-700">Require 2FA for Admin Users</h5>
                                        <p class="text-sm text-gray-500">Wajibkan 2FA untuk user dengan role admin</p>
                                    </div>
                                    <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 bg-gray-200" role="switch" aria-checked="false">
                                        <span class="translate-x-0 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Integration Settings -->
                    <div id="integrations" class="hidden mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Integration Settings</h3>
                        <div class="space-y-6">
                            <!-- Email Service -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Email Service</h4>
                                <div class="space-y-3">
                                    <div>
                                        <label for="smtp_host" class="block text-sm font-medium text-gray-700">SMTP Host</label>
                                        <input type="text" name="smtp_host" id="smtp_host" value="smtp.gmail.com" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="smtp_port" class="block text-sm font-medium text-gray-700">SMTP Port</label>
                                        <input type="number" name="smtp_port" id="smtp_port" value="587" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="smtp_username" class="block text-sm font-medium text-gray-700">SMTP Username</label>
                                        <input type="email" name="smtp_username" id="smtp_username" value="noreply@majubersama.com" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Gateway -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Payment Gateway</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-700">Midtrans</span>
                                        <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 bg-[#8D0907]" role="switch" aria-checked="true">
                                            <span class="translate-x-5 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                        </button>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-700">Xendit</span>
                                        <button type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#8D0907] focus:ring-offset-2 bg-gray-200" role="switch" aria-checked="false">
                                            <span class="translate-x-0 pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-end space-x-3">
                            <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907]">
                                Reset to Default
                            </button>
                            <button type="submit" class="bg-[#8D0907] py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907]">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple tab navigation
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('nav a');
            const sections = document.querySelectorAll('[id]');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('border-[#8D0907]', 'text-[#8D0907]'));
                    tabs.forEach(t => t.classList.add('border-transparent', 'text-gray-500'));
                    
                    // Add active class to clicked tab
                    this.classList.remove('border-transparent', 'text-gray-500');
                    this.classList.add('border-[#8D0907]', 'text-[#8D0907]');
                    
                    // Hide all sections
                    sections.forEach(section => section.classList.add('hidden'));
                    
                    // Show target section
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
</x-app-layout> 