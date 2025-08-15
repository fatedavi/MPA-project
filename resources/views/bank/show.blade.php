<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bank Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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
                                <a href="{{ route('bank.index') }}" class="text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                                    Bank Management
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="text-sm font-medium text-gray-500">Bank Details</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Header Actions -->
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Bank Details</h1>
                    <p class="mt-1 text-sm text-gray-600">View detailed information about this bank account</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('bank.edit', $bank) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Bank
                    </a>
                    <a href="{{ route('bank.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to List
                    </a>
                </div>
            </div>

            <!-- Bank Information Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Bank Information -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                        <h3 class="text-xl font-semibold text-blue-900 mb-4 flex items-center">
                            <i class="fas fa-university text-blue-600 mr-3 text-xl"></i>
                            Bank Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 text-gray-500">Bank ID</label>
                                <p class="mt-1 text-sm text-gray-900 font-semibold">{{ $bank->id }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 text-gray-500">Bank Name</label>
                                <p class="mt-1 text-sm text-gray-900 font-semibold">{{ $bank->nama_bank }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 text-gray-500">Account Name</label>
                                <p class="mt-1 text-sm text-gray-900 font-semibold">{{ $bank->an }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 text-gray-500">Account Number</label>
                                <p class="mt-1 text-sm text-gray-900 font-mono font-semibold">{{ $bank->ac }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-gray-600 mr-3 text-xl"></i>
                            Additional Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 text-gray-500">Created At</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $bank->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 text-gray-500">Last Updated</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $bank->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Related Invoices (if any) -->
                    @if($bank->invoices->count() > 0)
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mt-6">
                            <h3 class="text-xl font-semibold text-yellow-900 mb-4 flex items-center">
                                <i class="fas fa-file-invoice text-yellow-600 mr-3 text-xl"></i>
                                Related Invoices
                            </h3>
                            <p class="text-sm text-yellow-800 mb-4">
                                This bank account is being used in {{ $bank->invoices->count() }} invoice(s).
                            </p>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-yellow-200">
                                    <thead class="bg-yellow-100">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-yellow-800 uppercase">Invoice #</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-yellow-800 uppercase">Client</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-yellow-800 uppercase">Amount</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-yellow-800 uppercase">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-yellow-50 divide-y divide-yellow-200">
                                        @foreach($bank->invoices->take(5) as $invoice)
                                            <tr>
                                                <td class="px-4 py-2 text-sm text-yellow-900">
                                                    <a href="{{ route('invoice.show', $invoice) }}" class="text-blue-600 hover:text-blue-800">
                                                        {{ $invoice->no_invoice }}
                                                    </a>
                                                </td>
                                                <td class="px-4 py-2 text-sm text-yellow-900">{{ $invoice->nama_client }}</td>
                                                <td class="px-4 py-2 text-sm text-yellow-900">{{ 'Rp ' . number_format($invoice->total_invoice, 2, ',', '.') }}</td>
                                                <td class="px-4 py-2 text-sm text-yellow-900">
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                        @if($invoice->status === 'paid') bg-green-100 text-green-800
                                                        @elseif($invoice->status === 'sent') bg-blue-100 text-blue-800
                                                        @elseif($invoice->status === 'overdue') bg-red-100 text-red-800
                                                        @else bg-gray-100 text-gray-800
                                                        @endif">
                                                        {{ ucfirst($invoice->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($bank->invoices->count() > 5)
                                <p class="mt-2 text-xs text-yellow-700">
                                    Showing first 5 invoices. Total: {{ $bank->invoices->count() }} invoices.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
