<!-- JavaScript files -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/pace.min.js"></script>
<script src="assets/js/loader.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/shop-grid.js"></script>
<script src="assets/js/index.js"></script>
<script src="assets/js/quick-view.js"></script>
<!-- Plugins -->
<script src="assets/plugins/slick/slick.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.js"></script>

<!-- Force Bootstrap Carousel Initialization -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Force initialize Bootstrap carousel
    const carousel = document.getElementById('carouselExampleCaptions');
    if (carousel) {
        console.log('Carousel found, initializing...');
        const bsCarousel = new bootstrap.Carousel(carousel, {
            interval: 3000,
            ride: 'carousel'
        });
        
        // Force show the first slide
        setTimeout(function() {
            const firstSlide = carousel.querySelector('.carousel-item.active');
            if (firstSlide) {
                firstSlide.style.display = 'block';
                firstSlide.style.visibility = 'visible';
                firstSlide.style.opacity = '1';
            }
        }, 100);
    } else {
        console.log('Carousel not found!');
    }
});
</script>

<!-- Smooth Loading Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mark page content as loaded
    const pageContent = document.querySelector('.page-content');
    if (pageContent) {
        pageContent.classList.add('loaded');
    }
    
    // Immediately initialize hot deals slider to prevent layout shift
    const hotDealsContent = document.getElementById('hotDealsContent');
    if (hotDealsContent) {
        // Initialize Slick slider immediately
        $(hotDealsContent).slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            dots: true,
            arrows: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
        
        // Show content immediately after slider is initialized
        setTimeout(function() {
            hotDealsContent.style.opacity = '1';
            hotDealsContent.style.visibility = 'visible';
        }, 50);
    }
    
    // Smooth loading for all sections
    const sections = document.querySelectorAll('section');
    sections.forEach(function(section, index) {
        setTimeout(function() {
            section.classList.add('loaded');
        }, index * 100);
    });
});

// Prevent layout shift during image loading
window.addEventListener('load', function() {
    const images = document.querySelectorAll('img');
    images.forEach(function(img) {
        if (img.complete) {
            img.classList.add('loaded');
        } else {
            img.addEventListener('load', function() {
                this.classList.add('loaded');
            });
        }
    });
});
</script>
