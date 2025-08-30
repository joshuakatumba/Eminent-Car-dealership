<!--start forgot password form-->
<div class="card rounded-0">
  <div class="card-body p-4">
    <h4 class="mb-4 fw-bold text-center">Forgot Password</h4>
    <p class="text-muted text-center mb-4">Enter your email address and we'll send you a link to reset your password.</p>
    
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="row g-4">
            <div class="col-12">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-dark rounded-0 btn-ecomm w-100">Send Password Reset Link</button>
            </div>
            <div class="col-12 text-center">
                <a href="{{ route('login') }}" class="btn btn-outline-dark rounded-0 btn-ecomm w-100">
                    <i class="bi bi-arrow-left me-2"></i>Return to Login
                </a>
            </div>
        </div><!---end row-->
    </form>
  </div>
</div>
<!--end forgot password form-->
