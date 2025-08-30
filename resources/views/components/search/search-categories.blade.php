<h5 class="mb-0 fw-bold">Explore by categories</h5>
<div class="search-categories mt-4">
   <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-5 g-4">
     @forelse($categories as $category)
       <div class="col">
         <div class="card border-0 rounded-0 shadow bg-green">
           <div class="card-body p-4">
              <div class="d-flex align-items-center">
                 <div>
                    <h5 class="mb-0 fw-bold text-white">{{ $category->name }}</h5>
                  </div> 
                 <div class="ms-auto fs-1 text-white">
                    <i class="bi bi-car-front"></i>
                 </div> 
              </div>
           </div>
         </div>
       </div>
     @empty
       <div class="col-12 text-center">
         <p class="text-muted">No categories available.</p>
       </div>
     @endforelse
   </div><!--end row-->
</div>
