// Quick View Modal Functionality with Dynamic Slideshow
document.addEventListener('DOMContentLoaded', function () {
    let currentVehicleData = null;
    let slideshowInterval = null;
    let isPlaying = true;
    let currentSlideIndex = 0;
    let totalSlides = 0;
    let slideshowSpeed = 4000; // 4 seconds

    // Quick View Button Click Handler
    document.addEventListener('click', function (e) {
        if (e.target.closest('.quick-view-btn')) {
            e.preventDefault();
            const vehicleId = e.target.closest('.quick-view-btn').getAttribute('data-vehicle-id');
            // Store the vehicle ID for when modal opens
            document.getElementById('QuickViewModal').dataset.vehicleId = vehicleId;
        }
    });

    // Listen for Bootstrap modal show event
    const quickViewModalElement = document.getElementById('QuickViewModal');
    if (quickViewModalElement) {
        quickViewModalElement.addEventListener('show.bs.modal', function (event) {
            const vehicleId = quickViewModalElement.dataset.vehicleId;
            if (vehicleId) {
                loadQuickViewData(vehicleId);
            }
        });

        // Reset slideshow when modal is hidden
        quickViewModalElement.addEventListener('hidden.bs.modal', function (event) {
            stopSlideshow();
            resetSlideshow();
        });
    }

    // Load Quick View Data
    function loadQuickViewData(vehicleId) {
        showQuickViewLoading();

        fetch(`/api/vehicles/${vehicleId}/quick-view`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                currentVehicleData = data;
                populateQuickViewModal(data);
                initializeSlideshow();
            })
            .catch(error => {
                console.error('Error loading quick view data:', error);
                showQuickViewError();
            });
    }

    // Show Loading State
    function showQuickViewLoading() {
        const slideshowContainer = document.getElementById('slideshowContainer');
        const thumbnailWrapper = document.getElementById('thumbnailWrapper');

        slideshowContainer.innerHTML = `
            <div class="slideshow-loading">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;

        thumbnailWrapper.innerHTML = '';
    }

    // Show Error State
    function showQuickViewError() {
        const slideshowContainer = document.getElementById('slideshowContainer');
        slideshowContainer.innerHTML = `
            <div class="slideshow-loading">
                <div class="text-center">
                    <i class="bi bi-exclamation-triangle text-warning" style="font-size: 2rem;"></i>
                    <p class="mt-2">Failed to load vehicle images</p>
                </div>
            </div>
        `;
    }

    // Populate Quick View Modal
    function populateQuickViewModal(vehicle) {
        // Update vehicle information
        document.getElementById('quickViewVehicleTitle').textContent = `${vehicle.brand?.name || ''} ${vehicle.model || ''}`;
        document.getElementById('quickViewVehicleSubtitle').textContent = vehicle.description || 'Vehicle description';

        // Update price information
        const priceElement = document.getElementById('quickViewPrice');
        const originalPriceElement = document.getElementById('quickViewOriginalPrice');
        const discountElement = document.getElementById('quickViewDiscount');

        if (vehicle.sale_price && vehicle.sale_price > 0) {
            priceElement.textContent = `UGX ${vehicle.sale_price.toLocaleString()}`;
            originalPriceElement.textContent = `UGX ${vehicle.price.toLocaleString()}`;
            originalPriceElement.style.display = 'block';

            const discount = Math.round(((vehicle.price - vehicle.sale_price) / vehicle.price) * 100);
            discountElement.textContent = `(${discount}% off)`;
            discountElement.style.display = 'block';
        } else {
            priceElement.textContent = `UGX ${vehicle.price.toLocaleString()}`;
            originalPriceElement.style.display = 'none';
            discountElement.style.display = 'none';
        }

        // Update vehicle specifications
        document.getElementById('quickViewYear').textContent = vehicle.year || '-';
        document.getElementById('quickViewMileage').textContent = vehicle.mileage ? `${vehicle.mileage.toLocaleString()} km` : '-';
        document.getElementById('quickViewFuelType').textContent = vehicle.fuel_type ? vehicle.fuel_type.charAt(0).toUpperCase() + vehicle.fuel_type.slice(1) : '-';
        document.getElementById('quickViewTransmission').textContent = vehicle.transmission ? vehicle.transmission.charAt(0).toUpperCase() + vehicle.transmission.slice(1) : '-';
        document.getElementById('quickViewEngine').textContent = vehicle.engine_size ? `${vehicle.engine_size}L` : '-';
        document.getElementById('quickViewStatus').textContent = vehicle.status ? vehicle.status.charAt(0).toUpperCase() + vehicle.status.slice(1) : '-';

        // Update rating
        if (vehicle.star_rating && vehicle.star_rating > 0) {
            document.getElementById('quickViewRating').textContent = vehicle.star_rating;
            document.getElementById('quickViewRatingCount').textContent = `${vehicle.star_rating * 20} Ratings`;
        } else {
            document.getElementById('quickViewRating').textContent = '0';
            document.getElementById('quickViewRatingCount').textContent = 'No Ratings';
        }

        // Update action buttons
        const inquiryBtn = document.getElementById('quickViewInquiryBtn');
        const detailsBtn = document.getElementById('quickViewDetailsBtn');
        const wishlistBtn = document.getElementById('quickViewWishlistBtn');

        inquiryBtn.href = `/contact?vehicle=${vehicle.id}`;
        detailsBtn.href = `/vehicles/${vehicle.id}`;
        wishlistBtn.onclick = () => addToWishlist(vehicle.id);

        // Update fullscreen modal title
        document.getElementById('fullscreenVehicleTitle').textContent = `${vehicle.brand?.name || ''} ${vehicle.model || ''}`;
    }

    // Initialize Slideshow
    function initializeSlideshow() {
        if (!currentVehicleData || !currentVehicleData.images || currentVehicleData.images.length === 0) {
            showQuickViewError();
            return;
        }

        const images = currentVehicleData.images;
        totalSlides = images.length;
        currentSlideIndex = 0;

        // Create slides
        createSlides(images);

        // Create thumbnails
        createThumbnails(images);

        // Update counters
        updateCounters();

        // Start auto-play
        startSlideshow();

        // Setup event listeners
        setupSlideshowControls();
    }

    // Create Slides
    function createSlides(images) {
        const slideshowContainer = document.getElementById('slideshowContainer');
        slideshowContainer.innerHTML = '';

        images.forEach((image, index) => {
            const slide = document.createElement('div');
            slide.className = `slide ${index === 0 ? 'active' : ''}`;
            slide.dataset.index = index;

            const img = document.createElement('img');
            img.src = image.image_url || '/assets/images/placeholder-vehicle.svg';
            img.alt = `Vehicle image ${index + 1}`;
            img.className = 'main-image';

            slide.appendChild(img);
            slideshowContainer.appendChild(slide);
        });
    }

    // Create Thumbnails
    function createThumbnails(images) {
        const thumbnailWrapper = document.getElementById('thumbnailWrapper');
        thumbnailWrapper.innerHTML = '';

        images.forEach((image, index) => {
            const thumbnail = document.createElement('div');
            thumbnail.className = `thumbnail ${index === 0 ? 'active' : ''}`;
            thumbnail.dataset.index = index;

            const img = document.createElement('img');
            img.src = image.image_url || '/assets/images/placeholder-vehicle.svg';
            img.alt = `Vehicle thumbnail ${index + 1}`;

            thumbnail.appendChild(img);
            thumbnailWrapper.appendChild(thumbnail);

            // Add click event
            thumbnail.addEventListener('click', () => goToSlide(index));
        });
    }

    // Setup Slideshow Controls
    function setupSlideshowControls() {
        // Navigation buttons
        document.getElementById('prevBtn').addEventListener('click', () => previousSlide());
        document.getElementById('nextBtn').addEventListener('click', () => nextSlide());

        // Play/Pause button
        document.getElementById('playPauseBtn').addEventListener('click', toggleSlideshow);

        // Fullscreen button
        document.getElementById('fullscreenBtn').addEventListener('click', openFullscreen);

        // Fullscreen modal controls
        document.getElementById('fullscreenPrevBtn').addEventListener('click', () => {
            previousSlide();
            updateFullscreenImage();
        });

        document.getElementById('fullscreenNextBtn').addEventListener('click', () => {
            nextSlide();
            updateFullscreenImage();
        });

        document.getElementById('fullscreenPlayPauseBtn').addEventListener('click', toggleSlideshow);

        // Keyboard navigation
        document.addEventListener('keydown', handleKeyboardNavigation);

        // Touch/swipe support
        setupTouchSupport();
    }

    // Go to Specific Slide
    function goToSlide(index) {
        if (index < 0 || index >= totalSlides) return;

        // Remove active class from current slide and thumbnail
        document.querySelector('.slide.active').classList.remove('active');
        document.querySelector('.thumbnail.active').classList.remove('active');

        // Add active class to new slide and thumbnail
        document.querySelector(`.slide[data-index="${index}"]`).classList.add('active');
        document.querySelector(`.thumbnail[data-index="${index}"]`).classList.add('active');

        currentSlideIndex = index;
        updateCounters();
    }

    // Next Slide
    function nextSlide() {
        const nextIndex = (currentSlideIndex + 1) % totalSlides;
        goToSlide(nextIndex);
    }

    // Previous Slide
    function previousSlide() {
        const prevIndex = currentSlideIndex === 0 ? totalSlides - 1 : currentSlideIndex - 1;
        goToSlide(prevIndex);
    }

    // Start Slideshow
    function startSlideshow() {
        if (slideshowInterval) clearInterval(slideshowInterval);

        slideshowInterval = setInterval(() => {
            if (isPlaying) {
                nextSlide();
            }
        }, slideshowSpeed);
    }

    // Stop Slideshow
    function stopSlideshow() {
        if (slideshowInterval) {
            clearInterval(slideshowInterval);
            slideshowInterval = null;
        }
    }

    // Toggle Slideshow
    function toggleSlideshow() {
        isPlaying = !isPlaying;

        const playPauseBtn = document.getElementById('playPauseBtn');
        const fullscreenPlayPauseBtn = document.getElementById('fullscreenPlayPauseBtn');

        if (isPlaying) {
            playPauseBtn.innerHTML = '<i class="bi bi-pause-fill"></i>';
            fullscreenPlayPauseBtn.innerHTML = '<i class="bi bi-pause-fill"></i>';
            startSlideshow();
        } else {
            playPauseBtn.innerHTML = '<i class="bi bi-play-fill"></i>';
            fullscreenPlayPauseBtn.innerHTML = '<i class="bi bi-play-fill"></i>';
            stopSlideshow();
        }
    }

    // Update Counters
    function updateCounters() {
        document.getElementById('currentImage').textContent = currentSlideIndex + 1;
        document.getElementById('totalImages').textContent = totalSlides;
        document.getElementById('fullscreenCurrentImage').textContent = currentSlideIndex + 1;
        document.getElementById('fullscreenTotalImages').textContent = totalSlides;
    }

    // Reset Slideshow
    function resetSlideshow() {
        currentSlideIndex = 0;
        totalSlides = 0;
        isPlaying = true;
        stopSlideshow();
    }

    // Open Fullscreen
    function openFullscreen() {
        const fullscreenModal = new bootstrap.Modal(document.getElementById('fullscreenSlideshowModal'));
        fullscreenModal.show();
        updateFullscreenImage();
    }

    // Update Fullscreen Image
    function updateFullscreenImage() {
        if (!currentVehicleData || !currentVehicleData.images || currentVehicleData.images.length === 0) return;

        const currentImage = currentVehicleData.images[currentSlideIndex];
        const fullscreenImage = document.getElementById('fullscreenImage');

        fullscreenImage.src = currentImage.image_url || '/assets/images/placeholder-vehicle.svg';
        fullscreenImage.alt = `Vehicle image ${currentSlideIndex + 1}`;
    }

    // Handle Keyboard Navigation
    function handleKeyboardNavigation(event) {
        const quickViewModal = document.getElementById('QuickViewModal');
        const fullscreenModal = document.getElementById('fullscreenSlideshowModal');

        if (!quickViewModal.classList.contains('show') && !fullscreenModal.classList.contains('show')) return;

        switch (event.key) {
            case 'ArrowLeft':
                event.preventDefault();
                previousSlide();
                if (fullscreenModal.classList.contains('show')) {
                    updateFullscreenImage();
                }
                break;
            case 'ArrowRight':
                event.preventDefault();
                nextSlide();
                if (fullscreenModal.classList.contains('show')) {
                    updateFullscreenImage();
                }
                break;
            case ' ':
                event.preventDefault();
                toggleSlideshow();
                break;
            case 'Escape':
                if (fullscreenModal.classList.contains('show')) {
                    bootstrap.Modal.getInstance(fullscreenModal).hide();
                }
                break;
        }
    }

    // Setup Touch Support
    function setupTouchSupport() {
        const slideshowContainer = document.getElementById('slideshowContainer');
        let startX = 0;
        let endX = 0;

        slideshowContainer.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        });

        slideshowContainer.addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].clientX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = startX - endX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe left - next slide
                    nextSlide();
                } else {
                    // Swipe right - previous slide
                    previousSlide();
                }
            }
        }
    }

    // Add to Wishlist (placeholder function)
    function addToWishlist(vehicleId) {
        // Implement wishlist functionality
        console.log('Adding vehicle to wishlist:', vehicleId);
        alert('Vehicle added to wishlist!');
    }

    // Pause slideshow on hover
    const slideshowContainer = document.getElementById('slideshowContainer');
    if (slideshowContainer) {
        slideshowContainer.addEventListener('mouseenter', () => {
            if (isPlaying) {
                stopSlideshow();
            }
        });

        slideshowContainer.addEventListener('mouseleave', () => {
            if (isPlaying) {
                startSlideshow();
            }
        });
    }
});
