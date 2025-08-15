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
                                $statusColors = [
                                    'draft' => 'bg-gray-100 text-gray-800',
                                    'sent' => 'bg-blue-100 text-blue-800',
                                    'paid' => 'bg-green-100 text-green-800',
                                    'overdue' => 'bg-red-100 text-red-800',
                                    'cancelled' => 'bg-red-100 text-red-800'
                                ];
                                $statusColor = $statusColors[$invoice->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                                {{ ucfirst($invoice->status) }}
                            </span>
                            <div class="mt-2 text-sm text-gray-500">
                                Created: {{ \Carbon\Carbon::parse($invoice->created_at)->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Information -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Invoice Number</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->no_invoice }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Invoice Date</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($invoice->tgl_invoice)->format('M d, Y') }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-500">Description</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->hdeskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Client Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Client Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Client Name</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->nama_client }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Client Address</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->alamat_client }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin & UP Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Admin & UP Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Admin Code</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->kd_admin }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">UP</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->up }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- NBAST Information -->
                    @if($invoice->nbast || $invoice->nbast2 || $invoice->nbast3 || $invoice->nbast4 || $invoice->nbast5)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">NBAST Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @if($invoice->nbast)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">NBAST 1</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->nbast }}</p>
                                </div>
                                @endif
                                @if($invoice->nbast2)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">NBAST 2</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->nbast2 }}</p>
                                </div>
                                @endif
                                @if($invoice->nbast3)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">NBAST 3</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->nbast3 }}</p>
                                </div>
                                @endif
                                @if($invoice->nbast4)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">NBAST 4</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->nbast4 }}</p>
                                </div>
                                @endif
                                @if($invoice->nbast5)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">NBAST 5</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->nbast5 }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- FPB Information -->
                    @if($invoice->jenis_no || $invoice->no_fpb || $invoice->no_fpb2 || $invoice->no_fpb3 || $invoice->no_fpb4 || $invoice->no_fpb5)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">FPB Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @if($invoice->jenis_no)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Jenis No</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->jenis_no }}</p>
                                </div>
                                @endif
                                @if($invoice->no_fpb)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">No FPB 1</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->no_fpb }}</p>
                                </div>
                                @endif
                                @if($invoice->no_fpb2)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">No FPB 2</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->no_fpb2 }}</p>
                                </div>
                                @endif
                                @if($invoice->no_fpb3)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">No FPB 3</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->no_fpb3 }}</p>
                                </div>
                                @endif
                                @if($invoice->no_fpb4)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">No FPB 4</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->no_fpb4 }}</p>
                                </div>
                                @endif
                                @if($invoice->no_fpb5)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">No FPB 5</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->no_fpb5 }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Payment Summary -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Summary</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Total Amount:</span>
                                    <span class="text-lg font-semibold text-gray-900">IDR {{ number_format($invoice->total_invoice, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Due Date:</span>
                                    <span class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}</span>
                                </div>
                                @if($invoice->tgl_paid)
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Paid Date:</span>
                                    <span class="text-sm text-green-600">{{ \Carbon\Carbon::parse($invoice->tgl_paid)->format('M d, Y') }}</span>
                                </div>
                                @endif
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Status:</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
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
                                    <label class="block text-sm font-medium text-gray-500">Bank Name</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->nama_bank }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Account Name</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->an }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Account Number</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->ac }}</p>
                                </div>
                                @if($invoice->no_fp)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">FP Number</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $invoice->no_fp }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Actions</h3>
                            <div class="space-y-3">
                                <a href="{{ route('invoice.edit', $invoice->id) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-[#8D0907] hover:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit Invoice
                                </a>
                                <button class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Download PDF
                                </button>
                                <form action="{{ route('invoice.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this invoice?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
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
            @if($invoice->ttd !== 'blank.png' || $invoice->ttdkwitansi !== 'blank.png' || $invoice->ttdbast !== 'blank.png' || $invoice->ttdbakn !== 'blank.png')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Document Signatures</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        @if($invoice->ttd !== 'blank.png')
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Signature</label>
                            <img src="{{ asset('storage/signatures/' . $invoice->ttd) }}" alt="Signature" class="w-full h-32 object-cover rounded border">
                        </div>
                        @endif
                        @if($invoice->ttdkwitansi !== 'blank.png')
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Receipt Signature</label>
                            <img src="{{ asset('storage/signatures/' . $invoice->ttdkwitansi) }}" alt="Receipt Signature" class="w-full h-32 object-cover rounded border">
                        </div>
                        @endif
                        @if($invoice->ttdbast !== 'blank.png')
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">BAST Signature</label>
                            <img src="{{ asset('storage/signatures/' . $invoice->ttdbast) }}" alt="BAST Signature" class="w-full h-32 object-cover rounded border">
                        </div>
                        @endif
                        @if($invoice->ttdbakn !== 'blank.png')
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">BAKN Signature</label>
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
