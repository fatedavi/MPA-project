<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profile Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center space-x-6">
                        <div class="flex-shrink-0">
                            <div class="w-24 h-24 bg-gradient-to-r from-[#8D0907] to-[#B91C1C] rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                        </div>
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h1>
                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                            <div class="mt-2 flex items-center space-x-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active User
                                </span>
                                <span class="text-sm text-gray-500">Member since {{ Auth::user()->created_at->format('M Y') }}</span>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <button type="button" class="bg-[#8D0907] hover:bg-[#B91C1C] text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                Change Photo
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Information</h3>
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="phone" :value="__('Phone Number')" />
                                <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->phone ?? '')" autocomplete="tel" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <div>
                                <x-input-label for="position" :value="__('Position')" />
                                <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position', $user->position ?? '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('position')" />
                            </div>

                            <div>
                                <x-input-label for="department" :value="__('Department')" />
                                <select id="department" name="department" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                    <option value="">Select Department</option>
                                    <option value="development" {{ old('department', $user->department ?? '') == 'development' ? 'selected' : '' }}>Development</option>
                                    <option value="design" {{ old('department', $user->department ?? '') == 'design' ? 'selected' : '' }}>Design</option>
                                    <option value="qa" {{ old('department', $user->department ?? '') == 'qa' ? 'selected' : '' }}>QA</option>
                                    <option value="project_management" {{ old('department', $user->department ?? '') == 'project_management' ? 'selected' : '' }}>Project Management</option>
                                    <option value="sales" {{ old('department', $user->department ?? '') == 'sales' ? 'selected' : '' }}>Sales</option>
                                    <option value="marketing" {{ old('department', $user->department ?? '') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('department')" />
                            </div>

                            <div>
                                <x-input-label for="employee_id" :value="__('Employee ID')" />
                                <x-text-input id="employee_id" name="employee_id" type="text" class="mt-1 block w-full" :value="old('employee_id', $user->employee_id ?? '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('employee_id')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="bio" :value="__('Bio')" />
                            <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Tell us about yourself...">{{ old('bio', $user->bio ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="birth_date" :value="__('Birth Date')" />
                            <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full bg-gray-50" disabled />
                            <p class="mt-1 text-sm text-gray-500">Birth date information (coming soon)</p>
                        </div>

                        <div>
                            <x-input-label for="gender" :value="__('Gender')" />
                            <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 sm:text-sm" disabled>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Gender information (coming soon)</p>
                        </div>

                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <textarea id="address" name="address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 sm:text-sm" placeholder="Enter your address..." disabled></textarea>
                            <p class="mt-1 text-sm text-gray-500">Address information (coming soon)</p>
                        </div>

                        <div>
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full bg-gray-50" disabled />
                            <p class="mt-1 text-sm text-gray-500">City information (coming soon)</p>
                        </div>

                        <div>
                            <x-input-label for="state" :value="__('State/Province')" />
                            <x-text-input id="state" name="state" type="text" class="mt-1 block w-full bg-gray-50" disabled />
                            <p class="mt-1 text-sm text-gray-500">State information (coming soon)</p>
                        </div>

                        <div>
                            <x-input-label for="postal_code" :value="__('Postal Code')" />
                            <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full bg-gray-50" disabled />
                            <p class="mt-1 text-sm text-gray-500">Postal code information (coming soon)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Emergency Contact</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="emergency_name" :value="__('Emergency Contact Name')" />
                            <x-text-input id="emergency_name" name="emergency_name" type="text" class="mt-1 block w-full bg-gray-50" disabled />
                            <p class="mt-1 text-sm text-gray-500">Emergency contact information (coming soon)</p>
                        </div>

                        <div>
                            <x-input-label for="emergency_phone" :value="__('Emergency Contact Phone')" />
                            <x-text-input id="emergency_phone" name="emergency_phone" type="tel" class="mt-1 block w-full bg-gray-50" disabled />
                            <p class="mt-1 text-sm text-gray-500">Emergency phone information (coming soon)</p>
                        </div>

                        <div>
                            <x-input-label for="emergency_relationship" :value="__('Relationship')" />
                            <select id="emergency_relationship" name="emergency_relationship" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 sm:text-sm" disabled>
                                <option value="">Select Relationship</option>
                                <option value="spouse">Spouse</option>
                                <option value="parent">Parent</option>
                                <option value="sibling">Sibling</option>
                                <option value="friend">Friend</option>
                                <option value="other">Other</option>
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Relationship information (coming soon)</p>
                        </div>

                        <div>
                            <x-input-label for="emergency_address" :value="__('Emergency Contact Address')" />
                            <textarea id="emergency_address" name="emergency_address" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 sm:text-sm" placeholder="Enter emergency contact address..." disabled></textarea>
                            <p class="mt-1 text-sm text-gray-500">Emergency address information (coming soon)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Update Password</h3>
                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="current_password" :value="__('Current Password')" />
                                <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('New Password')" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'password-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Delete Account</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                    </p>

                    <x-danger-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    >{{ __('Delete Account') }}</x-danger-button>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
