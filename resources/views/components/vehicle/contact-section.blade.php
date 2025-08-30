<!-- Contact Section -->
<div class="contact-section">
    <div class="mb-3">
        <p class="mb-1 text-muted">Total price:</p>
        <div class="contact-price">
            @if($vehicle->sale_price && $vehicle->sale_price > 0)
                UGX {{ number_format($vehicle->sale_price) }}
            @else
                UGX {{ number_format($vehicle->price) }}
            @endif
        </div>
    </div>
    
    <div class="buttons d-flex flex-column gap-3">
        <button type="button" class="btn btn-lg btn-get-now px-4 py-3" data-bs-toggle="modal" data-bs-target="#inquiryModal">
            Get Now
        </button>
    </div>
</div>

<hr class="my-3">

<!-- Inquiry Modal -->
<div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inquiryModalLabel">Inquire About {{ $vehicle->brand->name }} {{ $vehicle->model }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="inquiryForm">
                @csrf
                <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="customerName" name="customer_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="contactNumber" class="form-label">Contact Number *</label>
                        <input type="tel" class="form-control" id="contactNumber" name="contact_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="vehicleInfo" class="form-label">Vehicle</label>
                        <input type="text" class="form-control" id="vehicleInfo" value="{{ $vehicle->brand->name }} {{ $vehicle->model }} ({{ $vehicle->year }})" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-get-now">Submit Inquiry</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success Notification Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <div class="success-icon mb-3">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h5 class="modal-title mb-3" id="successModalLabel">Inquiry Submitted Successfully!</h5>
                <p class="text-muted mb-4">Thank you for your interest in the {{ $vehicle->brand->name }} {{ $vehicle->model }}. We have captured your details and our team will contact you soon.</p>
                <div class="customer-details bg-light p-3 rounded mb-4">
                    <h6 class="mb-2">Your Details:</h6>
                    <p class="mb-1"><strong>Name:</strong> <span id="successCustomerName"></span></p>
                    <p class="mb-1"><strong>Contact:</strong> <span id="successContactNumber"></span></p>
                    <p class="mb-0"><strong>Vehicle:</strong> {{ $vehicle->brand->name }} {{ $vehicle->model }} ({{ $vehicle->year }})</p>
                </div>
                <button type="button" class="btn btn-get-now" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
.contact-section {
    margin-top: -50px;
}

.contact-price {
    font-size: 1.5rem;
    font-weight: bold;
    color: #007bff;
}

.btn-get-now {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

.btn-get-now:hover {
    background-color: #218838;
    border-color: #1e7e34;
    color: white;
}

.modal-content {
    border-radius: 10px;
}

.modal-header {
    border-bottom: 1px solid #dee2e6;
    background-color: #f8f9fa;
    border-radius: 10px 10px 0 0;
}

.modal-footer {
    border-top: 1px solid #dee2e6;
    background-color: #f8f9fa;
    border-radius: 0 0 10px 10px;
}

.success-icon {
    font-size: 4rem;
    color: #28a745;
}

.success-icon i {
    animation: bounceIn 0.6s ease-out;
}

@keyframes bounceIn {
    0% {
        transform: scale(0.3);
        opacity: 0;
    }
    50% {
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.customer-details {
    border-left: 4px solid #28a745;
}
</style>

<script>
document.getElementById('inquiryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    
    // Disable button and show loading
    submitBtn.disabled = true;
    submitBtn.textContent = 'Submitting...';
    
    fetch('{{ route("customer-orders.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Get customer details for success modal
            const customerName = formData.get('customer_name');
            const contactNumber = formData.get('contact_number');
            
            // Update success modal with customer details
            document.getElementById('successCustomerName').textContent = customerName;
            document.getElementById('successContactNumber').textContent = contactNumber;
            
            // Close inquiry modal
            const inquiryModal = bootstrap.Modal.getInstance(document.getElementById('inquiryModal'));
            inquiryModal.hide();
            
            // Show success modal
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            
            // Reset form
            this.reset();
        } else {
            alert('Error submitting inquiry. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error submitting inquiry. Please try again.');
    })
    .finally(() => {
        // Re-enable button
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
    });
});
</script>
