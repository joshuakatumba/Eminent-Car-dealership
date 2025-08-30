<!--start login form-->
<div class="card rounded-0">
  <div class="card-body p-4">
    <h4 class="mb-0 fw-bold text-center">User Login</h4>
    <hr>
    <p class="mb-2">Join / Sign In using</p>
    <div class="social-login mb-4">
     <div class="row g-4">
       <div class="col-xl-6">
           <button type="button" class="btn bg-facebook btn-ecomm w-100 text-white"><i class="bi bi-facebook me-2"></i>Facebook</button>
       </div>
       <div class="col-xl-6">
         <button type="button" class="btn bg-pinterest btn-ecomm w-100 text-white"><i class="bi bi-google me-2"></i>Google</button>
     </div>
      </div>
    </div>
    <div class="separator mb-4">
     <div class="line"></div>
     <p class="mb-0 fw-bold">Or</p>
     <div class="line"></div>
   </div>
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="row g-4">
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control rounded-0 @error('password') is-invalid @enderror" 
                       id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember" 
                           {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>
            </div>
            <div class="col-12">
                <a href="{{ route('password.request') }}" class="text-content btn bg-light rounded-0 w-100">
                    <i class="bi bi-lock me-2"></i>Forgot Password
                </a>
            </div>
            <div class="col-12">
                <hr class="my-0">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-dark rounded-0 btn-ecomm w-100">Login</button>
            </div>
            <div class="col-12 text-center">
                <p class="mb-0 rounded-0 w-100">Don't have an account? <a href="{{ route('register') }}" class="text-danger">Sign Up</a></p>
            </div>
        </div><!---end row-->
    </form>
  </div>
</div>
<!--end login form-->
