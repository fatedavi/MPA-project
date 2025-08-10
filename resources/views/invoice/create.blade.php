<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Invoice') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Add New Invoice</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('invoice.store') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Basic Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="invoice_number" class="block text-sm font-medium text-gray-700">Invoice Number *</label>
                                    <input type="text" name="invoice_number" id="invoice_number" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="INV-001">
                                </div>
                                
                                <div>
                                    <label for="invoice_type" class="block text-sm font-medium text-gray-700">Invoice Type</label>
                                    <select name="invoice_type" id="invoice_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="standard">Standard Invoice</option>
                                        <option value="recurring">Recurring Invoice</option>
                                        <option value="credit_memo">Credit Memo</option>
                                        <option value="debit_memo">Debit Memo</option>
                                    </select>
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
                                    <label for="project_id" class="block text-sm font-medium text-gray-700">Project *</label>
                                    <select name="project_id" id="project_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="">Select project</option>
                                        <option value="1">MPA System Development</option>
                                        <option value="2">Jakarta Smart City Portal</option>
                                        <option value="3">Bank Indonesia Mobile App</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Details -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Invoice Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="issue_date" class="block text-sm font-medium text-gray-700">Issue Date *</label>
                                    <input type="date" name="issue_date" id="issue_date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                </div>
                                
                                <div>
                                    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date *</label>
                                    <input type="date" name="due_date" id="due_date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                </div>
                                
                                <div>
                                    <label for="currency" class="block text-sm font-medium text-gray-700">Currency</label>
                                    <select name="currency" id="currency" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="IDR" selected>Indonesian Rupiah (IDR)</option>
                                        <option value="USD">US Dollar (USD)</option>
                                        <option value="EUR">Euro (EUR)</option>
                                        <option value="SGD">Singapore Dollar (SGD)</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="draft" selected>Draft</option>
                                        <option value="sent">Sent</option>
                                        <option value="viewed">Viewed</option>
                                        <option value="paid">Paid</option>
                                        <option value="overdue">Overdue</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Items -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Invoice Items</h3>
                            <div id="invoice-items" class="space-y-4">
                                <div class="invoice-item border border-gray-200 rounded-lg p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Description *</label>
                                            <input type="text" name="items[0][description]" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Service description">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Quantity *</label>
                                            <input type="number" name="items[0][quantity]" min="1" step="1" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="1">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Rate *</label>
                                            <input type="number" name="items[0][rate]" min="0" step="0.01" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="0.00">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Amount</label>
                                            <input type="number" name="items[0][amount]" min="0" step="0.01" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 sm:text-sm" placeholder="0.00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <button type="button" id="add-item" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#8D0907] transition-colors">
                                    <svg class="-ml-0.5 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Add Item
                                </button>
                            </div>
                        </div>

                        <!-- Totals -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Totals</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Subtotal:</span>
                                            <span class="text-sm font-medium text-gray-900" id="subtotal">IDR 0.00</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Tax Rate:</span>
                                            <select name="tax_rate" id="tax_rate" class="text-sm border-gray-300 rounded-md focus:ring-[#8D0907] focus:border-[#8D0907]">
                                                <option value="0">0%</option>
                                                <option value="10" selected>10%</option>
                                                <option value="11">11%</option>
                                            </select>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Tax Amount:</span>
                                            <span class="text-sm font-medium text-gray-900" id="tax-amount">IDR 0.00</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Discount:</span>
                                            <input type="number" name="discount" id="discount" min="0" step="0.01" value="0" class="text-sm border-gray-300 rounded-md focus:ring-[#8D0907] focus:border-[#8D0907] w-24">
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="flex justify-between text-lg font-semibold border-t pt-3">
                                            <span>Total:</span>
                                            <span id="total">IDR 0.00</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Amount Due:</span>
                                            <span class="text-sm font-semibold text-[#8D0907]" id="amount-due">IDR 0.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Additional notes or terms"></textarea>
                                </div>
                                
                                <div>
                                    <label for="payment_terms" class="block text-sm font-medium text-gray-700">Payment Terms</label>
                                    <select name="payment_terms" id="payment_terms" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="net_15">Net 15</option>
                                        <option value="net_30" selected>Net 30</option>
                                        <option value="net_45">Net 45</option>
                                        <option value="net_60">Net 60</option>
                                        <option value="due_on_receipt">Due on Receipt</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm">
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="cash">Cash</option>
                                        <option value="check">Check</option>
                                        <option value="paypal">PayPal</option>
                                    </select>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Create Invoice
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple JavaScript for invoice calculations
        document.addEventListener('DOMContentLoaded', function() {
            const addItemBtn = document.getElementById('add-item');
            const invoiceItems = document.getElementById('invoice-items');
            let itemCount = 1;

            addItemBtn.addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.className = 'invoice-item border border-gray-200 rounded-lg p-4';
                newItem.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description *</label>
                            <input type="text" name="items[${itemCount}][description]" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="Service description">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Quantity *</label>
                            <input type="number" name="items[${itemCount}][quantity]" min="1" step="1" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Rate *</label>
                            <input type="number" name="items[${itemCount}][rate]" min="0" step="0.01" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#8D0907] focus:border-[#8D0907] sm:text-sm" placeholder="0.00">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Amount</label>
                            <input type="number" name="items[${itemCount}][amount]" min="0" step="0.01" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 sm:text-sm" placeholder="0.00">
                        </div>
                    </div>
                    <div class="mt-2 text-right">
                        <button type="button" class="text-red-600 hover:text-red-800 text-sm" onclick="this.parentElement.parentElement.remove(); calculateTotals();">Remove</button>
                    </div>
                `;
                
                invoiceItems.appendChild(newItem);
                itemCount++;
            });

            // Calculate totals when inputs change
            invoiceItems.addEventListener('input', function(e) {
                if (e.target.name && e.target.name.includes('[quantity]') || e.target.name.includes('[rate]')) {
                    calculateTotals();
                }
            });

            function calculateTotals() {
                let subtotal = 0;
                const items = invoiceItems.querySelectorAll('.invoice-item');
                
                items.forEach(item => {
                    const quantity = parseFloat(item.querySelector('input[name*="[quantity]"]').value) || 0;
                    const rate = parseFloat(item.querySelector('input[name*="[rate]"]').value) || 0;
                    const amount = quantity * rate;
                    
                    item.querySelector('input[name*="[amount]"]').value = amount.toFixed(2);
                    subtotal += amount;
                });

                const taxRate = parseFloat(document.getElementById('tax-rate').value) || 0;
                const taxAmount = subtotal * (taxRate / 100);
                const discount = parseFloat(document.getElementById('discount').value) || 0;
                const total = subtotal + taxAmount - discount;

                document.getElementById('subtotal').textContent = `IDR ${subtotal.toFixed(2)}`;
                document.getElementById('tax-amount').textContent = `IDR ${taxAmount.toFixed(2)}`;
                document.getElementById('total').textContent = `IDR ${total.toFixed(2)}`;
                document.getElementById('amount-due').textContent = `IDR ${total.toFixed(2)}`;
            }

            // Initial calculation
            calculateTotals();
        });
    </script>
</x-app-layout> 