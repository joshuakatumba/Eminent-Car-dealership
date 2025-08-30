<!--start contact form-->
<div class="separator my-3">
  <div class="line"></div>
  <h3 class="mb-0 h3 fw-bold">{{ $contactInfo['why_choose_us_title'] ?? 'Why Choose Us' }}</h3>
  <div class="line"></div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row g-4">
  <div class="col-xl-8">
    <div class="p-4 border">
      <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <div class="form-body">
          <h4 class="mb-0 fw-bold">{{ $contactInfo['contact_form_title'] ?? 'Drop Us a Line' }}</h4>
          <div class="my-3 border-bottom"></div>
          <div class="mb-3">
            <label class="form-label">Enter Your Name</label>
            <input type="text" name="name" class="form-control rounded-0 @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Enter Email</label>
            <input type="email" name="email" class="form-control rounded-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control rounded-0 @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control rounded-0 @error('message') is-invalid @enderror" rows="4" cols="4" required>{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-0">
            <button type="submit" class="btn btn-dark btn-ecomm">Send Message</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="col-xl-4">
    <div class="p-3 border">
      <div class="address mb-3">
        <h5 class="mb-0 fw-bold">Address</h5>
        <p class="mb-0 font-12">{{ $contactInfo['address'] ?? '123 Street Name, City, Australia' }}</p>
      </div>
      <hr>
      <div class="phone mb-3">
        <h5 class="mb-0 fw-bold">Phone</h5>
        <p class="mb-0 font-13">{{ $contactInfo['phone'] ?? '+256 774 959 446' }}</p>
      </div>
      <hr>
      <div class="email mb-3">
        <h5 class="mb-0 fw-bold">Email</h5>
        <p class="mb-0 font-13">{{ $contactInfo['email'] ?? 'info@eminent.com' }}</p>
      </div>
      <hr>
      <div class="working-days mb-0">
        <h5 class="mb-0 fw-bold">Working Days</h5>
        <p class="mb-0 font-13">{{ $contactInfo['working_hours'] ?? 'Mon - FRI / 9:30 AM - 6:30 PM' }}</p>
      </div>
    </div>
  </div>
</div>
<!--end contact form-->
