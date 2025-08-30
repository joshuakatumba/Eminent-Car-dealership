@extends('admin.layouts.app')

@section('title', 'Edit Sale')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit"></i> Edit Sale #{{ $sale->id }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sales.update', $sale) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Customer Information -->
                        <div class="col-md-6 mb-3">
                            <label for="customer_id" class="form-label">Customer *</label>
                            <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" required>
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id', $sale->customer_id) == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->first_name }} {{ $customer->last_name }} - {{ $customer->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Vehicle Information -->
                        <div class="col-md-6 mb-3">
                            <label for="vehicle_id" class="form-label">Vehicle *</label>
                            <select class="form-select @error('vehicle_id') is-invalid @enderror" id="vehicle_id" name="vehicle_id" required>
                                <option value="">Select Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $sale->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->brand->name }} {{ $vehicle->model }} - UGX {{ number_format($vehicle->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Salesperson -->
                        <div class="col-md-6 mb-3">
                            <label for="salesperson_id" class="form-label">Salesperson *</label>
                            <select class="form-select @error('salesperson_id') is-invalid @enderror" id="salesperson_id" name="salesperson_id" required>
                                <option value="">Select Salesperson</option>
                                @foreach($salespeople as $salesperson)
                                    <option value="{{ $salesperson->id }}" {{ old('salesperson_id', $sale->salesperson_id) == $salesperson->id ? 'selected' : '' }}>
                                        {{ $salesperson->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('salesperson_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sale Date -->
                        <div class="col-md-6 mb-3">
                            <label for="sale_date" class="form-label">Sale Date *</label>
                            <input type="date" class="form-control @error('sale_date') is-invalid @enderror" 
                                   id="sale_date" name="sale_date" 
                                   value="{{ old('sale_date', $sale->sale_date ? $sale->sale_date->format('Y-m-d') : '') }}" required>
                            @error('sale_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sale Price -->
                        <div class="col-md-6 mb-3">
                            <label for="sale_price" class="form-label">Sale Price *</label>
                            <div class="input-group">
                                <span class="input-group-text">UGX</span>
                                <input type="number" step="0.01" class="form-control @error('sale_price') is-invalid @enderror" 
                                       id="sale_price" name="sale_price" value="{{ old('sale_price', $sale->sale_price) }}" required>
                            </div>
                            @error('sale_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Down Payment -->
                        <div class="col-md-6 mb-3">
                            <label for="down_payment" class="form-label">Down Payment</label>
                            <div class="input-group">
                                <span class="input-group-text">UGX</span>
                                <input type="number" step="0.01" class="form-control @error('down_payment') is-invalid @enderror" 
                                       id="down_payment" name="down_payment" value="{{ old('down_payment', $sale->down_payment) }}">
                            </div>
                            @error('down_payment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Financing Amount -->
                        <div class="col-md-6 mb-3">
                            <label for="financing_amount" class="form-label">Financing Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">UGX</span>
                                <input type="number" step="0.01" class="form-control @error('financing_amount') is-invalid @enderror" 
                                       id="financing_amount" name="financing_amount" value="{{ old('financing_amount', $sale->financing_amount) }}">
                            </div>
                            @error('financing_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Trade-in Value -->
                        <div class="col-md-6 mb-3">
                            <label for="trade_in_value" class="form-label">Trade-in Value</label>
                            <div class="input-group">
                                <span class="input-group-text">UGX</span>
                                <input type="number" step="0.01" class="form-control @error('trade_in_value') is-invalid @enderror" 
                                       id="trade_in_value" name="trade_in_value" value="{{ old('trade_in_value', $sale->trade_in_value) }}">
                            </div>
                            @error('trade_in_value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tax Amount -->
                        <div class="col-md-6 mb-3">
                            <label for="tax_amount" class="form-label">Tax Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">UGX</span>
                                <input type="number" step="0.01" class="form-control @error('tax_amount') is-invalid @enderror" 
                                       id="tax_amount" name="tax_amount" value="{{ old('tax_amount', $sale->tax_amount) }}">
                            </div>
                            @error('tax_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Total Amount -->
                        <div class="col-md-6 mb-3">
                            <label for="total_amount" class="form-label">Total Amount *</label>
                            <div class="input-group">
                                <span class="input-group-text">UGX</span>
                                <input type="number" step="0.01" class="form-control @error('total_amount') is-invalid @enderror" 
                                       id="total_amount" name="total_amount" value="{{ old('total_amount', $sale->total_amount) }}" required>
                            </div>
                            @error('total_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Method -->
                        <div class="col-md-6 mb-3">
                            <label for="payment_method" class="form-label">Payment Method *</label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method" required>
                                <option value="">Select Payment Method</option>
                                <option value="cash" {{ old('payment_method', $sale->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="financing" {{ old('payment_method', $sale->payment_method) == 'financing' ? 'selected' : '' }}>Financing</option>
                                <option value="lease" {{ old('payment_method', $sale->payment_method) == 'lease' ? 'selected' : '' }}>Lease</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="completed" {{ old('status', $sale->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="pending" {{ old('status', $sale->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="cancelled" {{ old('status', $sale->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="col-12 mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3" placeholder="Additional notes about the sale...">{{ old('notes', $sale->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.sales.show', $sale) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Sale Details
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Sale
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Auto-calculate total amount
document.addEventListener('DOMContentLoaded', function() {
    const salePrice = document.getElementById('sale_price');
    const downPayment = document.getElementById('down_payment');
    const financingAmount = document.getElementById('financing_amount');
    const tradeInValue = document.getElementById('trade_in_value');
    const taxAmount = document.getElementById('tax_amount');
    const totalAmount = document.getElementById('total_amount');

    function calculateTotal() {
        const sale = parseFloat(salePrice.value) || 0;
        const down = parseFloat(downPayment.value) || 0;
        const financing = parseFloat(financingAmount.value) || 0;
        const tradeIn = parseFloat(tradeInValue.value) || 0;
        const tax = parseFloat(taxAmount.value) || 0;

        // Total = Sale Price + Tax - Trade-in Value
        const total = sale + tax - tradeIn;
        totalAmount.value = total.toFixed(2);
    }

    salePrice.addEventListener('input', calculateTotal);
    downPayment.addEventListener('input', calculateTotal);
    financingAmount.addEventListener('input', calculateTotal);
    tradeInValue.addEventListener('input', calculateTotal);
    taxAmount.addEventListener('input', calculateTotal);
});
</script>
@endpush
