<!--start blog sidebar-->
<div class="blog-left-sidebar border p-4">
  <form>
    <div class="blog-categories recent-post mb-4">
      <h5 class="mb-4 fw-bold">Recent Posts</h5>
      @if(isset($relatedPosts) && $relatedPosts->count() > 0)
        @foreach($relatedPosts as $post)
          <div class="d-flex align-items-start">
            @if($post->featured_image)
              <img src="{{ $post->featured_image }}" width="100" alt="{{ $post->title }}">
            @else
              <img src="assets/images/blog/01.webp" width="100" alt="{{ $post->title }}">
            @endif
            <div class="ms-3"> 
              <a href="{{ route('blog.show', $post->slug) }}" class="fs-6 fw-bold text-content">{{ $post->title }}</a>
              <p class="mb-0">{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</p>
            </div>
          </div>
          @if(!$loop->last)
            <div class="my-3 border-bottom"></div>
          @endif
        @endforeach
      @elseif(isset($recentPosts) && $recentPosts->count() > 0)
        @foreach($recentPosts as $post)
          <div class="d-flex align-items-start">
            @if($post->featured_image)
              <img src="{{ $post->featured_image }}" width="100" alt="{{ $post->title }}">
            @else
              <img src="assets/images/blog/01.webp" width="100" alt="{{ $post->title }}">
            @endif
            <div class="ms-3"> 
              <a href="{{ route('blog.show', $post->slug) }}" class="fs-6 fw-bold text-content">{{ $post->title }}</a>
              <p class="mb-0">{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</p>
            </div>
          </div>
          @if(!$loop->last)
            <div class="my-3 border-bottom"></div>
          @endif
        @endforeach
      @else
        <div class="d-flex align-items-start">
          <img src="assets/images/blog/01.webp" width="100" alt="">
          <div class="ms-3"> 
            <a href="javascript:;" class="fs-6 fw-bold text-content">No recent posts</a>
            <p class="mb-0">Check back later for new content</p>
          </div>
        </div>
      @endif
    </div>
  </form>
</div>
<!--end blog sidebar-->
