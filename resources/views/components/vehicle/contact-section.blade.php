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

/* Fallback modal styles */
.modal.show {
    display: block !important;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1040;
    transition: opacity 0.15s linear;
}

.modal-backdrop.fade {
    opacity: 0;
}

.modal-backdrop.show {
    opacity: 1;
}

.modal-open {
    overflow: hidden;
}

/* Ensure proper z-index for modals */
#inquiryModal {
    z-index: 1050;
}

#successModal {
    z-index: 1060;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Contact section script loaded');
    
    // Get all required elements
    const inquiryForm = document.getElementById('inquiryForm');
    const getNowBtn = document.querySelector('.btn-get-now');
    const inquiryModal = document.getElementById('inquiryModal');
    const successModal = document.getElementById('successModal');
    
    // Check if elements exist
    if (!inquiryForm) {
        console.error('❌ Inquiry form not found');
        return;
    }
    
    if (!getNowBtn) {
        console.error('❌ Get Now button not found');
        return;
    }
    
    if (!inquiryModal) {
        console.error('❌ Inquiry modal not found');
        return;
    }
    
    if (!successModal) {
        console.error('❌ Success modal not found');
        return;
    }
    
    console.log('✅ All elements found');
    
    // Test Bootstrap availability
    if (typeof bootstrap !== 'undefined') {
        console.log('✅ Bootstrap is loaded and available');
    } else {
        console.error('❌ Bootstrap is not loaded! Using fallback method');
    }
    
    // Function to manually show modal (fallback if Bootstrap fails)
    function showModal(modalElement) {
        if (typeof bootstrap !== 'undefined') {
            const bsModal = new bootstrap.Modal(modalElement);
            bsModal.show();
        } else {
            // Fallback: manually show modal
            modalElement.style.display = 'block';
            modalElement.classList.add('show');
            modalElement.setAttribute('aria-hidden', 'false');
            document.body.classList.add('modal-open');
            
            // Add backdrop
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            document.body.appendChild(backdrop);
        }
    }
    
    // Function to manually hide modal (fallback if Bootstrap fails)
    function hideModal(modalElement) {
        if (typeof bootstrap !== 'undefined') {
            const bsModal = bootstrap.Modal.getInstance(modalElement);
            if (bsModal) {
                bsModal.hide();
            }
        } else {
            // Fallback: manually hide modal
            modalElement.style.display = 'none';
            modalElement.classList.remove('show');
            modalElement.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('modal-open');
            
            // Remove backdrop
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        }
        
        // Always clean up backdrop regardless of method
        cleanupModalBackdrop();
    }
    
    // Function to clean up modal backdrop
    function cleanupModalBackdrop() {
        // Remove any remaining modal backdrops
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(backdrop => {
            backdrop.remove();
        });
        
        // Remove modal-open class from body
        document.body.classList.remove('modal-open');
        
        // Remove any inline styles that might have been added
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    }
    
    // Add click event listener for the Get Now button
    getNowBtn.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('Get Now button clicked - opening inquiry modal');
        showModal(inquiryModal);
    });
    
    // Add close functionality for modals
    const closeButtons = document.querySelectorAll('[data-bs-dismiss="modal"], .btn-close');
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal');
            if (modal) {
                hideModal(modal);
            }
        });
    });
    
    // Close modal when clicking outside
    inquiryModal.addEventListener('click', function(e) {
        if (e.target === this) {
            hideModal(this);
        }
    });
    
    successModal.addEventListener('click', function(e) {
        if (e.target === this) {
            hideModal(this);
        }
    });
    
    // Add specific close button handling for success modal
    const successCloseButtons = successModal.querySelectorAll('[data-bs-dismiss="modal"], .btn-close');
    successCloseButtons.forEach(button => {
        button.addEventListener('click', function() {
            hideModal(successModal);
            // Ensure complete cleanup after success modal is closed
            setTimeout(() => {
                cleanupModalBackdrop();
            }, 150);
        });
    });
    
    // Handle form submission
    inquiryForm.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('Form submission started');
        
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        // Log form data for debugging
        console.log('Form data:', {
            customer_name: formData.get('customer_name'),
            contact_number: formData.get('contact_number'),
            vehicle_id: formData.get('vehicle_id')
        });
        
        // Disable button and show loading
        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';
        
        fetch('{{ route("customer-orders.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.success) {
                // Get customer details for success modal
                const customerName = formData.get('customer_name');
                const contactNumber = formData.get('contact_number');
                
                // Update success modal with customer details
                const successCustomerName = document.getElementById('successCustomerName');
                const successContactNumber = document.getElementById('successContactNumber');
                
                if (successCustomerName) successCustomerName.textContent = customerName;
                if (successContactNumber) successContactNumber.textContent = contactNumber;
                
                // Close inquiry modal and clean up backdrop
                hideModal(inquiryModal);
                
                // Ensure backdrop is completely removed before showing success modal
                setTimeout(() => {
                    cleanupModalBackdrop();
                    
                    // Show success modal
                    showModal(successModal);
                }, 100);
                
                // Reset form
                this.reset();
                
                console.log('✅ Inquiry submitted successfully! Order sent to admin panel.');
                console.log('Order details:', {
                    customer_name: customerName,
                    contact_number: contactNumber,
                    vehicle_id: formData.get('vehicle_id')
                });
            } else {
                console.error('❌ Server returned error:', data);
                alert('Error submitting inquiry: ' + (data.message || 'Please try again.'));
            }
        })
        .catch(error => {
            console.error('❌ Error submitting inquiry:', error);
            alert('Error submitting inquiry. Please try again. Check the console for more details.');
        })
        .finally(() => {
            // Re-enable button
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        });
    });
    
    console.log('✅ Contact section script fully loaded and ready');
});
</script>
