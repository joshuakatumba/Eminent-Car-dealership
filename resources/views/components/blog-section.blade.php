<!-- Blog Section -->
<section class="section-padding blog-section">
    <div class="container">
        <div class="text-center pb-3">
            <h3 class="mb-0 fw-bold">Latest Blog</h3>
            <p class="mb-0 text-capitalize">Check our latest news</p>
        </div>
        <div class="blog-cards">
            <div class="row row-cols-1 row-cols-lg-3 g-4">
                @php
                    $latestPosts = \App\Models\BlogPost::with('author')
                        ->where('status', 'published')
                        ->whereNotNull('published_at')
                        ->orderBy('published_at', 'desc')
                        ->limit(3)
                        ->get();
                @endphp
                
                @forelse($latestPosts as $post)
                    <div class="col">
                        <div class="card">
                            @if($post->featured_image)
                                <img src="{{ $post->featured_image_url }}" class="card-img-top rounded-0" alt="{{ $post->title }}">
                            @else
                                <img src="{{ asset('assets/images/blog/0' . ($loop->iteration) . '.webp') }}" class="card-img-top rounded-0" alt="{{ $post->title }}">
                            @endif
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="posted-by">
                                        <p class="mb-0"><i class="bi bi-person me-2"></i>{{ $post->author->name ?? 'Eminent Team' }}</p>
                                    </div>
                                    <div class="posted-date">
                                        <p class="mb-0"><i class="bi bi-calendar me-2"></i>{{ $post->published_at->format('d M, Y') }}</p>
                                    </div>
                                </div>
                                <h5 class="card-title fw-bold mt-3">{{ $post->title }}</h5>
                                <p class="mb-0">{{ $post->excerpt }}</p>
                                <a href="{{ route('blog.index') }}" class="btn btn-outline-dark btn-ecomm mt-3">Read More</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback content if no blog posts exist -->
                    <div class="col">
                        <div class="card">
                            <img src="{{ asset('assets/images/blog/01.webp') }}" class="card-img-top rounded-0" alt="Blog Post">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="posted-by">
                                        <p class="mb-0"><i class="bi bi-person me-2"></i>Eminent Team</p>
                                    </div>
                                    <div class="posted-date">
                                        <p class="mb-0"><i class="bi bi-calendar me-2"></i>{{ date('d M, Y') }}</p>
                                    </div>
                                </div>
                                <h5 class="card-title fw-bold mt-3">Coming Soon: Latest Automotive News</h5>
                                <p class="mb-0">Stay tuned for the latest automotive industry insights, maintenance tips, and car buying guides.</p>
                                <a href="{{ route('blog.index') }}" class="btn btn-outline-dark btn-ecomm mt-3">View All Posts</a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <!--end row-->
        </div>
        
        @if($latestPosts->count() > 0)
            <div class="text-center mt-4">
                <a href="{{ route('blog.index') }}" class="btn btn-primary btn-ecomm">View All Blog Posts</a>
            </div>
        @endif
    </div>
</section>
