<!--start register form-->
<div class="card rounded-0">
  <div class="card-body p-4">
    <h4 class="mb-0 fw-bold text-center">Registration</h4>
    <hr>
    <p class="mb-2">Join / Sign Up using</p>
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
    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div class="row g-4">
            <div class="col-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control rounded-0 @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="phone" class="form-label">Mobile</label>
                <input type="text" class="form-control rounded-0 @error('phone') is-invalid @enderror" 
                       id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="email" class="form-label">Email ID</label>
                <input type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" required>
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
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control rounded-0" 
                       id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input @error('terms') is-invalid @enderror" 
                           type="checkbox" value="1" id="terms" name="terms" 
                           {{ old('terms') ? 'checked' : '' }} required>
                    <label class="form-check-label" for="terms">
                        I agree to Terms and Conditions
                    </label>
                    @error('terms')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <hr class="my-0">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-dark rounded-0 btn-ecomm w-100">Sign Up</button>
            </div>
            <div class="col-12 text-center">
                <p class="mb-0 rounded-0 w-100">Already have an account? <a href="{{ route('login') }}" class="text-danger">Sign In</a></p>
            </div>
        </div><!---end row-->
    </form>
  </div>
</div>
<!--end register form-->
