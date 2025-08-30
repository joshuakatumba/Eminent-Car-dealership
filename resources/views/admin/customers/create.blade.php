@extends('admin.layouts.app')

@section('title', 'Create Customer')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Create New Customer</h4>
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Customers
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.customers.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Personal Information</h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">First Name</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                                   id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Last Name</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                                   id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control @error('age') is-invalid @enderror" 
                                           id="age" name="age" value="{{ old('age') }}" min="18" max="100">
                                    @error('age')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-3">Location Information</h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                                   id="city" name="city" value="{{ old('city') }}" required>
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="district" class="form-label">District</label>
                                            <input type="text" class="form-control @error('district') is-invalid @enderror" 
                                                   id="district" name="district" value="{{ old('district') }}">
                                            @error('district')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                                   id="state" name="state" value="{{ old('state') }}" required>
                                            @error('state')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="zip_code" class="form-label">ZIP Code</label>
                                            <input type="text" class="form-control @error('zip_code') is-invalid @enderror" 
                                                   id="zip_code" name="zip_code" value="{{ old('zip_code') }}" required>
                                            @error('zip_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <h5 class="mb-3 mt-4">Additional Information</h5>
                                
                                <div class="mb-3">
                                    <label for="driver_license_number" class="form-label">Driver's License Number</label>
                                    <input type="text" class="form-control @error('driver_license_number') is-invalid @enderror" 
                                           id="driver_license_number" name="driver_license_number" value="{{ old('driver_license_number') }}">
                                    @error('driver_license_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Customer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
