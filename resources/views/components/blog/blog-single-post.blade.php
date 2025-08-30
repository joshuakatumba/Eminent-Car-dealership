<!--start blog single post-->
<div class="d-flex flex-column gap-4">
  <div class="card rounded-0 border">
    @if($blogPost->featured_image_url)
      <img src="{{ $blogPost->featured_image_url }}" class="card-img-top rounded-0 mb-3" alt="{{ $blogPost->title }}">
    @else
      <img src="assets/images/blog/01.webp" class="card-img-top rounded-0 mb-3" alt="{{ $blogPost->title }}">
    @endif
    <div class="card-body">
      <div class="d-flex align-items-center gap-4">
        <div class="posted-by">
          <p class="mb-0"><i class="bi bi-person me-2"></i>{{ $blogPost->author->name ?? 'Admin' }}</p>
        </div>
        <div class="posted-date">
          <p class="mb-0"><i class="bi bi-calendar me-2"></i>{{ $blogPost->published_at ? $blogPost->published_at->format('d M, Y') : $blogPost->created_at->format('d M, Y') }}</p>
        </div>
      </div>
                        <h4 class="card-title fw-bold mt-3">{{ $blogPost->title }}</h4>
                  @if($blogPost->excerpt)
                    <p class="mb-0"><em>{{ $blogPost->excerpt }}</em></p>
                    <br>
                  @endif
                  
                  @if($blogPost->tags)
                    <div class="mb-4">
                      <strong>Tags:</strong>
                      @foreach(explode(',', $blogPost->tags) as $tag)
                        <a href="{{ route('blog.index', ['tag' => trim($tag)]) }}" class="badge bg-secondary text-white me-1 text-decoration-none">
                          {{ trim($tag) }}
                        </a>
                      @endforeach
                    </div>
                  @endif
      <div class="blog-content">
        {!! $blogPost->content !!}
      </div>
    
      <div class="d-flex align-items-center gap-3 py-3 border-top border-bottom">
        <div class="">
          <h5 class="mb-0 fw-bold">Share This Post</h5>
        </div>
        <div class="footer-widget-9">
           <div class="social-link d-flex flex-wrap align-items-center gap-2">
             <a href="javascript:;"><i class="bi bi-facebook"></i></a>
             <a href="javascript:;"><i class="bi bi-twitter"></i></a>
             <a href="javascript:;"><i class="bi bi-linkedin"></i></a>
             <a href="javascript:;"><i class="bi bi-youtube"></i></a>
             <a href="javascript:;"><i class="bi bi-instagram"></i></a>
           </div>
        </div>
      </div>
      <div class="author d-flex align-items-start gap-3 my-3">
        <img src="assets/images/avatars/01.jpg" class="" alt="{{ $blogPost->author->name ?? 'Admin' }}" width="80">
        <div class="">
          <h6 class="mb-0">{{ $blogPost->author->name ?? 'Admin' }}</h6>
          <p class="mb-0">{{ $blogPost->author->email ?? 'admin@cardealership.com' }}</p>
        </div>
      </div>
      <hr>
      <div class="reply-form p-4 border">
        <h5 class="mb-0 fw-bold">Leave a Reply</h5>
        <p>Your email address will not be published. Required fields are marked *</p>
        <form>
          <div class="mb-3">
            <label class="form-label">Comment</label>
            <textarea class="form-control rounded-0" rows="4"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control rounded-0" placeholder="">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control rounded-0">
          </div>
          <div class="mb-3">
            <label class="form-label">Website</label>
            <input type="text" class="form-control rounded-0">
          </div>
          <div class="mb-0">
            <button type="button" class="btn btn-dark btn-ecomm">Post Comment</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--end blog single post-->
