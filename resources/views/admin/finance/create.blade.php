@extends('admin.layouts.app')

@section('title', 'Create Financing Application')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-plus"></i> Create New Financing Application
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.finance.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <!-- Customer Information -->
                        <div class="col-md-6 mb-3">
                            <label for="customer_id" class="form-label">Customer *</label>
                            <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" required>
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
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
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->brand->name }} {{ $vehicle->model }} - UGX {{ number_format($vehicle->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Loan Amount -->
                        <div class="col-md-6 mb-3">
                            <label for="loan_amount" class="form-label">Loan Amount *</label>
                            <div class="input-group">
                                <span class="input-group-text">UGX</span>
                                <input type="number" step="0.01" class="form-control @error('loan_amount') is-invalid @enderror" 
                                       id="loan_amount" name="loan_amount" value="{{ old('loan_amount') }}" required>
                            </div>
                            @error('loan_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Down Payment -->
                        <div class="col-md-6 mb-3">
                            <label for="down_payment" class="form-label">Down Payment *</label>
                            <div class="input-group">
                                <span class="input-group-text">UGX</span>
                                <input type="number" step="0.01" class="form-control @error('down_payment') is-invalid @enderror" 
                                       id="down_payment" name="down_payment" value="{{ old('down_payment') }}" required>
                            </div>
                            @error('down_payment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Loan Term -->
                        <div class="col-md-6 mb-3">
                            <label for="loan_term_months" class="form-label">Loan Term (Months) *</label>
                            <select class="form-select @error('loan_term_months') is-invalid @enderror" id="loan_term_months" name="loan_term_months" required>
                                <option value="">Select Term</option>
                                <option value="12" {{ old('loan_term_months') == '12' ? 'selected' : '' }}>12 Months</option>
                                <option value="24" {{ old('loan_term_months') == '24' ? 'selected' : '' }}>24 Months</option>
                                <option value="36" {{ old('loan_term_months') == '36' ? 'selected' : '' }}>36 Months</option>
                                <option value="48" {{ old('loan_term_months') == '48' ? 'selected' : '' }}>48 Months</option>
                                <option value="60" {{ old('loan_term_months') == '60' ? 'selected' : '' }}>60 Months</option>
                                <option value="72" {{ old('loan_term_months') == '72' ? 'selected' : '' }}>72 Months</option>
                                <option value="84" {{ old('loan_term_months') == '84' ? 'selected' : '' }}>84 Months</option>
                            </select>
                            @error('loan_term_months')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Interest Rate -->
                        <div class="col-md-6 mb-3">
                            <label for="interest_rate" class="form-label">Interest Rate (%) *</label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control @error('interest_rate') is-invalid @enderror" 
                                       id="interest_rate" name="interest_rate" value="{{ old('interest_rate') }}" required>
                                <span class="input-group-text">%</span>
                            </div>
                            @error('interest_rate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Monthly Payment -->
                        <div class="col-md-6 mb-3">
                            <label for="monthly_payment" class="form-label">Monthly Payment *</label>
                            <div class="input-group">
                                <span class="input-group-text">UGX</span>
                                <input type="number" step="0.01" class="form-control @error('monthly_payment') is-invalid @enderror" 
                                       id="monthly_payment" name="monthly_payment" value="{{ old('monthly_payment') }}" required>
                            </div>
                            @error('monthly_payment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Employment Status -->
                        <div class="col-md-6 mb-3">
                            <label for="employment_status" class="form-label">Employment Status *</label>
                            <select class="form-select @error('employment_status') is-invalid @enderror" id="employment_status" name="employment_status" required>
                                <option value="">Select Status</option>
                                <option value="employed" {{ old('employment_status') == 'employed' ? 'selected' : '' }}>Employed</option>
                                <option value="self_employed" {{ old('employment_status') == 'self_employed' ? 'selected' : '' }}>Self Employed</option>
                                <option value="unemployed" {{ old('employment_status') == 'unemployed' ? 'selected' : '' }}>Unemployed</option>
                                <option value="retired" {{ old('employment_status') == 'retired' ? 'selected' : '' }}>Retired</option>
                            </select>
                            @error('employment_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Employer Name -->
                        <div class="col-md-6 mb-3">
                            <label for="employer_name" class="form-label">Employer Name</label>
                            <input type="text" class="form-control @error('employer_name') is-invalid @enderror" 
                                   id="employer_name" name="employer_name" value="{{ old('employer_name') }}">
                            @error('employer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Job Title -->
                        <div class="col-md-6 mb-3">
                            <label for="job_title" class="form-label">Job Title</label>
                            <input type="text" class="form-control @error('job_title') is-invalid @enderror" 
                                   id="job_title" name="job_title" value="{{ old('job_title') }}">
                            @error('job_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Monthly Income -->
                        <div class="col-md-6 mb-3">
                            <label for="monthly_income" class="form-label">Monthly Income *</label>
                            <div class="input-group">
                                <span class="input-group-text">UGX</span>
                                <input type="number" step="0.01" class="form-control @error('monthly_income') is-invalid @enderror" 
                                       id="monthly_income" name="monthly_income" value="{{ old('monthly_income') }}" required>
                            </div>
                            @error('monthly_income')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Credit Score -->
                        <div class="col-md-6 mb-3">
                            <label for="credit_score" class="form-label">Credit Score *</label>
                            <input type="number" class="form-control @error('credit_score') is-invalid @enderror" 
                                   id="credit_score" name="credit_score" value="{{ old('credit_score') }}" 
                                   min="300" max="850" required>
                            @error('credit_score')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div class="col-12 mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3" placeholder="Additional notes about the application...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.finance.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Finance Applications
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Application
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
// Auto-calculate monthly payment
document.addEventListener('DOMContentLoaded', function() {
    const loanAmount = document.getElementById('loan_amount');
    const interestRate = document.getElementById('interest_rate');
    const loanTerm = document.getElementById('loan_term_months');
    const monthlyPayment = document.getElementById('monthly_payment');

    function calculateMonthlyPayment() {
        const principal = parseFloat(loanAmount.value) || 0;
        const rate = parseFloat(interestRate.value) || 0;
        const term = parseFloat(loanTerm.value) || 0;

        if (principal > 0 && rate > 0 && term > 0) {
            const monthlyRate = rate / 100 / 12;
            const payment = principal * (monthlyRate * Math.pow(1 + monthlyRate, term)) / (Math.pow(1 + monthlyRate, term) - 1);
            monthlyPayment.value = payment.toFixed(2);
        }
    }

    loanAmount.addEventListener('input', calculateMonthlyPayment);
    interestRate.addEventListener('input', calculateMonthlyPayment);
    loanTerm.addEventListener('change', calculateMonthlyPayment);
});
</script>
@endpush
