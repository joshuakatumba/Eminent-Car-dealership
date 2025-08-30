<!--start add new address modal-->
<!-- New Address Modal -->
<div class="modal" id="NewAddress" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-0">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">Add New Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="">
           <h6 class="fw-bold mb-3">Contact Details</h6>
           <div class="form-floating mb-3">
            <input type="text" class="form-control rounded-0" id="floatingName" placeholder="Name">
            <label for="floatingName">Name</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control rounded-0" id="floatingMobileNo" placeholder="Mobile No">
            <label for="floatingMobileNo">Mobile No</label>
          </div>
         </div>

         <div class="mt-4">
          <h6 class="fw-bold mb-3">Address</h6>
          <div class="form-floating mb-3">
           <input type="text" class="form-control rounded-0" id="floatingPinCode" placeholder="Pin Code">
           <label for="floatingPinCode">Pin Code</label>
         </div>
         <div class="form-floating mb-3">
           <input type="text" class="form-control rounded-0" id="floatingAddress" placeholder="Address (House No, Building, Street, Area)">
           <label for="floatingAddress">Address</label>
         </div>
         <div class="form-floating mb-3">
          <input type="text" class="form-control rounded-0" id="floatingLocalityTown" placeholder="Locality/Town">
          <label for="floatingLocalityTown">Locality / Town</label>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-floating">
              <input type="text" class="form-control rounded-0" id="floatingCity" placeholder="City / District">
              <label for="floatingAddress">City / District</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating">
              <input type="text" class="form-control rounded-0" id="floatingState" placeholder="State">
              <label for="floatingState">State</label>
            </div>
          </div>
         </div>
        </div>

      </div>
      <div class="modal-footer">
        <div class="d-grid w-100">
          <button type="button" class="btn btn-dark py-3 px-5 btn-ecomm">Add Address</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end add new address modal-->
