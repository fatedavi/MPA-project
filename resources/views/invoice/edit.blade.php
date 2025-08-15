<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Invoice') }}
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
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit Invoice</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('invoice.update', $invoice->id) }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Basic Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="no_invoice" class="block text-sm font-medium text-gray-700">Invoice Number</label>
                                    <input type="text" name="no_invoice" id="no_invoice" value="{{ $invoice->no_invoice }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" readonly>
                                    <p class="mt-1 text-xs text-gray-500">Invoice number cannot be changed</p>
                                </div>
                                
                                <div>
                                    <label for="tgl_invoice" class="block text-sm font-medium text-gray-700">Invoice Date *</label>
                                    <input type="date" name="tgl_invoice" id="tgl_invoice" value="{{ $invoice->tgl_invoice }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="hdeskripsi" class="block text-sm font-medium text-gray-700">Description *</label>
                                    <textarea name="hdeskripsi" id="hdeskripsi" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Invoice description">{{ $invoice->hdeskripsi }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Client Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Client Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_client" class="block text-sm font-medium text-gray-700">Client Name *</label>
                                    <input type="text" name="nama_client" id="nama_client" value="{{ $invoice->nama_client }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Client name">
                                </div>
                                
                                <div>
                                    <label for="alamat_client" class="block text-sm font-medium text-gray-700">Client Address *</label>
                                    <textarea name="alamat_client" id="alamat_client" rows="2" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Client address">{{ $invoice->alamat_client }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Admin & UP Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Admin & UP Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="kd_admin" class="block text-sm font-medium text-gray-700">Admin Code *</label>
                                    <input type="number" name="kd_admin" id="kd_admin" value="{{ $invoice->kd_admin }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Admin code">
                                </div>
                                
                                <div>
                                    <label for="up" class="block text-sm font-medium text-gray-700">UP *</label>
                                    <input type="text" name="up" id="up" value="{{ $invoice->up }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="UP">
                                </div>
                            </div>
                        </div>

                        <!-- NBAST Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">NBAST Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="nbast" class="block text-sm font-medium text-gray-700">NBAST 1</label>
                                    <input type="text" name="nbast" id="nbast" value="{{ $invoice->nbast }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="NBAST 1">
                                </div>
                                <div>
                                    <label for="nbast2" class="block text-sm font-medium text-gray-700">NBAST 2</label>
                                    <input type="text" name="nbast2" id="nbast2" value="{{ $invoice->nbast2 }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="NBAST 2">
                                </div>
                                <div>
                                    <label for="nbast3" class="block text-sm font-medium text-gray-700">NBAST 3</label>
                                    <input type="text" name="nbast3" id="nbast3" value="{{ $invoice->nbast3 }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="NBAST 3">
                                </div>
                                <div>
                                    <label for="nbast4" class="block text-sm font-medium text-gray-700">NBAST 4</label>
                                    <input type="text" name="nbast4" id="nbast4" value="{{ $invoice->nbast4 }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="NBAST 4">
                                </div>
                                <div>
                                    <label for="nbast5" class="block text-sm font-medium text-gray-700">NBAST 5</label>
                                    <input type="text" name="nbast5" id="nbast5" value="{{ $invoice->nbast5 }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="NBAST 5">
                                </div>
                            </div>
                        </div>

                        <!-- FPB Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">FPB Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="jenis_no" class="block text-sm font-medium text-gray-700">Jenis No</label>
                                    <input type="text" name="jenis_no" id="jenis_no" value="{{ $invoice->jenis_no }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Jenis No">
                                </div>
                                <div>
                                    <label for="no_fpb" class="block text-sm font-medium text-gray-700">No FPB 1</label>
                                    <input type="text" name="no_fpb" id="no_fpb" value="{{ $invoice->no_fpb }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="No FPB 1">
                                </div>
                                <div>
                                    <label for="no_fpb2" class="block text-sm font-medium text-gray-700">No FPB 2</label>
                                    <input type="text" name="no_fpb2" id="no_fpb2" value="{{ $invoice->no_fpb2 }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="No FPB 2">
                                </div>
                                <div>
                                    <label for="no_fpb3" class="block text-sm font-medium text-gray-700">No FPB 3</label>
                                    <input type="text" name="no_fpb3" id="no_fpb3" value="{{ $invoice->no_fpb3 }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="No FPB 3">
                                </div>
                                <div>
                                    <label for="no_fpb4" class="block text-sm font-medium text-gray-700">No FPB 4</label>
                                    <input type="text" name="no_fpb4" id="no_fpb4" value="{{ $invoice->no_fpb4 }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="No FPB 4">
                                </div>
                                <div>
                                    <label for="no_fpb5" class="block text-sm font-medium text-gray-700">No FPB 5</label>
                                    <input type="text" name="no_fpb5" id="no_fpb5" value="{{ $invoice->no_fpb5 }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="No FPB 5">
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date *</label>
                                    <input type="date" name="due_date" id="due_date" value="{{ $invoice->due_date }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                </div>
                                
                                <div>
                                    <label for="total_invoice" class="block text-sm font-medium text-gray-700">Total Invoice *</label>
                                    <input type="number" name="total_invoice" id="total_invoice" min="0" step="0.01" value="{{ $invoice->total_invoice }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="0.00">
                                </div>
                                
                                <div>
                                    <label for="nama_bank" class="block text-sm font-medium text-gray-700">Bank Name *</label>
                                    <input type="text" name="nama_bank" id="nama_bank" value="{{ $invoice->nama_bank }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Bank name">
                                </div>
                                
                                <div>
                                    <label for="an" class="block text-sm font-medium text-gray-700">Account Name *</label>
                                    <input type="text" name="an" id="an" value="{{ $invoice->an }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Account name">
                                </div>
                                
                                <div>
                                    <label for="ac" class="block text-sm font-medium text-gray-700">Account Number *</label>
                                    <input type="text" name="ac" id="ac" value="{{ $invoice->ac }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Account number">
                                </div>
                                
                                <div>
                                    <label for="no_fp" class="block text-sm font-medium text-gray-700">FP Number</label>
                                    <input type="text" name="no_fp" id="no_fp" value="{{ $invoice->no_fp }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="FP number">
                                </div>
                            </div>
                        </div>

                        <!-- Status & Additional Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Status & Additional Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                    <select name="status" id="status" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select status</option>
                                        <option value="draft" {{ $invoice->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="sent" {{ $invoice->status === 'sent' ? 'selected' : '' }}>Sent</option>
                                        <option value="paid" {{ $invoice->status === 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="overdue" {{ $invoice->status === 'overdue' ? 'selected' : '' }}>Overdue</option>
                                        <option value="cancelled" {{ $invoice->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="tgl_paid" class="block text-sm font-medium text-gray-700">Payment Date</label>
                                    <input type="date" name="tgl_paid" id="tgl_paid" value="{{ $invoice->tgl_paid }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Document Uploads -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Document Uploads</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="ttd" class="block text-sm font-medium text-gray-700">Signature</label>
                                    @if($invoice->ttd && $invoice->ttd !== 'blank.png')
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/signatures/' . $invoice->ttd) }}" alt="Current signature" class="w-20 h-20 object-cover rounded border">
                                        </div>
                                    @endif
                                    <input type="file" name="ttd" id="ttd" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                    <p class="mt-1 text-xs text-gray-500">Current: {{ $invoice->ttd }}</p>
                                </div>
                                
                                <div>
                                    <label for="ttdkwitansi" class="block text-sm font-medium text-gray-700">Receipt Signature</label>
                                    @if($invoice->ttdkwitansi && $invoice->ttdkwitansi !== 'blank.png')
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/signatures/' . $invoice->ttdkwitansi) }}" alt="Current receipt signature" class="w-20 h-20 object-cover rounded border">
                                        </div>
                                    @endif
                                    <input type="file" name="ttdkwitansi" id="ttdkwitansi" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                    <p class="mt-1 text-xs text-gray-500">Current: {{ $invoice->ttdkwitansi }}</p>
                                </div>
                                
                                <div>
                                    <label for="ttdbast" class="block text-sm font-medium text-gray-700">BAST Signature</label>
                                    @if($invoice->ttdbast && $invoice->ttdbast !== 'blank.png')
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/signatures/' . $invoice->ttdbast) }}" alt="Current BAST signature" class="w-20 h-20 object-cover rounded border">
                                        </div>
                                    @endif
                                    <input type="file" name="ttdbast" id="ttdbast" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                    <p class="mt-1 text-xs text-gray-500">Current: {{ $invoice->ttdbast }}</p>
                                </div>
                                
                                <div>
                                    <label for="ttdbakn" class="block text-sm font-medium text-gray-700">BAKN Signature</label>
                                    @if($invoice->ttdbakn && $invoice->ttdbakn !== 'blank.png')
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/signatures/' . $invoice->ttdbakn) }}" alt="Current BAKN signature" class="w-20 h-20 object-cover rounded border">
                                        </div>
                                    @endif
                                    <input type="file" name="ttdbakn" id="ttdbakn" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                    <p class="mt-1 text-xs text-gray-500">Current: {{ $invoice->ttdbakn }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('invoice.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#8D0907] hover:bg-[#B91C1C] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Invoice
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
