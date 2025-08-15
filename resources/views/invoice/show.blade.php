<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('invoice.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#8D0907]">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                                Invoices
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $invoice->no_invoice }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Invoice Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $invoice->no_invoice }}</h1>
                            <p class="text-gray-600 mt-1">{{ $invoice->hdeskripsi }}</p>
                        </div>
                        <div class="text-right">
                            @php
                                $statusColor = match($invoice->status) {
                                    'paid' => 'bg-green-100 text-green-800',
                                    'overdue' => 'bg-red-100 text-red-800',
                                    'sent' => 'bg-blue-100 text-blue-800',
                                    'draft' => 'bg-gray-100 text-gray-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800'
                                };
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                                {{ ucfirst($invoice->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Invoice Date</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->tgl_invoice->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Due Date</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->due_date->format('d M Y') }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Description</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->hdeskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Client Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Client Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Client Name</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->nama_client }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Client Address</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->alamat_client }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Invoice Items -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Invoice Items</h3>
                            @if($invoice->detail_invoice_array && count($invoice->detail_invoice_array) > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($invoice->detail_invoice_array as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['deskripsi'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['qty'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['satuan'] ?? 'pcs' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Total Summary -->
                                <div class="mt-6 border-t border-gray-200 pt-4">
                                    <div class="flex justify-end">
                                        <div class="text-right">
                                            <div class="text-lg font-medium text-gray-900">
                                                Total: Rp {{ number_format($invoice->total_invoice, 2, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4">No items found</p>
                            @endif
                        </div>
                    </div>

                    <!-- NBAST & FPB Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">NBAST & FPB Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="text-md font-medium text-gray-700 mb-3">NBAST</h4>
                                    <div class="space-y-2">
                                        @if($invoice->nbast)<div><span class="text-sm text-gray-600">NBAST 1:</span> <span class="text-sm font-medium">{{ $invoice->nbast }}</span></div>@endif
                                        @if($invoice->nbast2)<div><span class="text-sm text-gray-600">NBAST 2:</span> <span class="text-sm font-medium">{{ $invoice->nbast2 }}</span></div>@endif
                                        @if($invoice->nbast3)<div><span class="text-sm text-gray-600">NBAST 3:</span> <span class="text-sm font-medium">{{ $invoice->nbast3 }}</span></div>@endif
                                        @if($invoice->nbast4)<div><span class="text-sm text-gray-600">NBAST 4:</span> <span class="text-sm font-medium">{{ $invoice->nbast4 }}</span></div>@endif
                                        @if($invoice->nbast5)<div><span class="text-sm text-gray-600">NBAST 5:</span> <span class="text-sm font-medium">{{ $invoice->nbast5 }}</span></div>@endif
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-md font-medium text-gray-700 mb-3">FPB</h4>
                                    <div class="space-y-2">
                                        @if($invoice->jenis_no)<div><span class="text-sm text-gray-600">Jenis No:</span> <span class="text-sm font-medium">{{ $invoice->jenis_no }}</span></div>@endif
                                        @if($invoice->no_fpb)<div><span class="text-sm text-gray-600">No FPB 1:</span> <span class="text-sm font-medium">{{ $invoice->no_fpb }}</span></div>@endif
                                        @if($invoice->no_fpb2)<div><span class="text-sm text-gray-600">No FPB 2:</span> <span class="text-sm font-medium">{{ $invoice->no_fpb2 }}</span></div>@endif
                                        @if($invoice->no_fpb3)<div><span class="text-sm text-gray-600">No FPB 3:</span> <span class="text-sm font-medium">{{ $invoice->no_fpb3 }}</span></div>@endif
                                        @if($invoice->no_fpb4)<div><span class="text-sm text-gray-600">No FPB 4:</span> <span class="text-sm font-medium">{{ $invoice->no_fpb4 }}</span></div>@endif
                                        @if($invoice->no_fpb5)<div><span class="text-sm text-gray-600">No FPB 5:</span> <span class="text-sm font-medium">{{ $invoice->no_fpb5 }}</span></div>@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Payment Summary -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Summary</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Total Amount:</span>
                                    <span class="text-lg font-bold text-gray-900">Rp {{ number_format($invoice->total_invoice, 0, ',', '.') }}</span>
                                </div>
                                @if($invoice->tgl_paid)
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Payment Date:</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $invoice->tgl_paid->format('d M Y') }}</span>
                                </div>
                                @endif
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Status:</span>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Bank Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Bank Name</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->nama_bank }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Account Name</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->an }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Account Number</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->ac }}</p>
                                </div>
                                @if($invoice->no_fp)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">FP Number</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->no_fp }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Admin & UP Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Admin & UP Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Admin Code</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->kd_admin }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">UP</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->up }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Actions</h3>
                            <div class="space-y-3">
                                <a href="{{ route('invoice.edit', $invoice->id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit Invoice
                                </a>
                                
                                <!-- PDF Actions -->
                                <div class="grid grid-cols-2 gap-3">
                                    <a href="{{ route('invoice.pdf', $invoice->id) }}" target="_blank" class="inline-flex justify-center items-center px-4 py-2 border border-blue-300 shadow-sm text-sm font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View PDF
                                    </a>
                                    <a href="{{ route('invoice.download', $invoice->id) }}" class="inline-flex justify-center items-center px-4 py-2 border border-green-300 shadow-sm text-sm font-medium rounded-md text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Download PDF
                                    </a>
                                </div>
                                
                                <form action="{{ route('invoice.destroy', $invoice->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this invoice?')" class="w-full inline-flex justify-center items-center px-4 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete Invoice
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Signatures -->
            @if($invoice->ttd || $invoice->ttdkwitansi || $invoice->ttdbast || $invoice->ttdbakn)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Document Signatures</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        @if($invoice->ttd)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Signature</label>
                            <img src="{{ asset('storage/signatures/' . $invoice->ttd) }}" alt="Signature" class="w-full h-32 object-cover rounded border">
                        </div>
                        @endif
                        @if($invoice->ttdkwitansi)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Receipt Signature</label>
                            <img src="{{ asset('storage/signatures/' . $invoice->ttdkwitansi) }}" alt="Receipt Signature" class="w-full h-32 object-cover rounded border">
                        </div>
                        @endif
                        @if($invoice->ttdbast)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">BAST Signature</label>
                            <img src="{{ asset('storage/signatures/' . $invoice->ttdbast) }}" alt="BAST Signature" class="w-full h-32 object-cover rounded border">
                        </div>
                        @endif
                        @if($invoice->ttdbakn)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">BAKN Signature</label>
                            <img src="{{ asset('storage/signatures/' . $invoice->ttdbakn) }}" alt="BAKN Signature" class="w-full h-32 object-cover rounded border">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
