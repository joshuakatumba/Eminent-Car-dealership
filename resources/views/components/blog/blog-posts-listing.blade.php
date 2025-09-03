<!--start blog posts listing-->
@if(isset($currentTag) && $currentTag)
  <div class="alert alert-info mb-4">
    <i class="bi bi-tag me-2"></i>
    Showing posts tagged with: <strong>"{{ $currentTag }}"</strong>
    <a href="{{ route('blog.index') }}" class="btn btn-sm btn-outline-secondary ms-3">
      <i class="bi bi-x-circle me-1"></i> Clear Filter
    </a>
  </div>
@endif

<div class="d-flex flex-column gap-4">
  @forelse($blogPosts as $post)
    <div class="card rounded-0">
      @if($post->featured_image_url)
        <img src="{{ $post->featured_image_url }}" class="card-img-top rounded-0" alt="{{ $post->title }}">
      @else
        <img src="assets/images/blog/01.webp" class="card-img-top rounded-0" alt="{{ $post->title }}">
      @endif
      <div class="card-body">
        <div class="d-flex align-items-center gap-4">
          <div class="posted-by">
            <p class="mb-0"><i class="bi bi-person me-2"></i>{{ $post->author->name ?? 'Admin' }}</p>
          </div>
          <div class="posted-date">
            <p class="mb-0"><i class="bi bi-calendar me-2"></i>{{ $post->published_at ? $post->published_at->format('d M, Y') : $post->created_at->format('d M, Y') }}</p>
          </div>
        </div>
                            <h4 class="card-title fw-bold mt-3">{{ $post->title }}</h4>
                    <p class="mb-0">{{ $post->excerpt ?: Str::limit(strip_tags($post->content), 200) }}</p>
                    
                    {{-- @if($post->tags)
                      <div class="mt-3 mb-3">
                        @foreach(explode(',', $post->tags) as $tag)
                          <a href="{{ route('blog.index', ['tag' => trim($tag)]) }}" class="badge bg-light text-dark me-1 text-decoration-none">
                            {{ trim($tag) }}
                          </a>
                        @endforeach
                      </div>
                    @endif --}}
                    

      </div>
    </div>
  @empty
    <div class="card rounded-0">
      <div class="card-body text-center">
        <h4 class="card-title fw-bold">No Blog Posts Available</h4>
        <p class="mb-0">No blog posts have been published yet. Please check back later!</p>
      </div>
    </div>
  @endforelse
</div>

@if($blogPosts->hasPages())
  <div class="d-flex justify-content-center mt-4">
    {{ $blogPosts->links() }}
  </div>
@endif
<!--end blog posts listing-->
