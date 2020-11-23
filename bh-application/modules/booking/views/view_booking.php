<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth multi-step-login theme-one" style="background-image: linear-gradient(140deg, #FDDBE2, #fff);">
      <div class="row w-100">
        <div class="col-md-6 mx-auto">
          <h3 class="text-center pt-5"><?php echo strtoupper( 'Alex Boarding House Booking' ); ?></h3>
          <p class="text-center text-muted">Please provide correct details below for your booking.</p>
          <form class="step-form auto-form-wrapper" id="msform">

            <ul class="step-progress" id="progressbar">
              <li class="active">Check Availablity</li>
              <li>Personal Details</li>
              <li>Login Details</li>
              <li>Finish</li>
            </ul>

            <fieldset id="check" class="shadow-sm">
              <div class="form-group">
                <div class="input-group">
                  <input type="number" name="persons" class="form-control" placeholder="Number of persons" required />
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                    </span>
                  </div>
                </div>
              </div>
              <button class="btn btn-danger submit-btn next action-button float-right" id="check-btn" type="button" name="next" value="Next">Check Availability</button>
            </fieldset>
            
            <fieldset id="personal" class="shadow-sm">
              <div class="p-container"></div>
              <button class="btn btn-danger submit-btn next action-button float-left" id="personal-back" type="button" name="next" value="Next">Back</button>
              <button class="btn btn-danger submit-btn next action-button float-right" id="personal-btn" type="button" name="next" value="Next">Next</button>
            </fieldset>

            <fieldset id="login" class="shadow-sm">
              <div class="l-container"></div>
              <button class="btn btn-danger submit-btn next action-button float-left" id="login-back" type="button" name="next" value="Next">Back</button>
              <button class="btn btn-danger submit-btn next action-button float-right" id="login-btn" type="button" name="next" value="Next">Save & Confirm Booking</button>
            </fieldset>

            <fieldset class="text-center shadow-sm" id="finish">
              <i class="mdi mdi-shield-check text-success icon-lg"></i>
              <h4 class="font-weight-bold">Booking successful</h4>
              <p class="mb-0 text-muted">We will get intouch with you soon after booking is confirm.</p>
            </fieldset>

            <div class="text-center mt-4">
              <p>
                <?php credits( 'co' ); ?><br />
                <a href="#" style="color: gray;">Privacy Policy</a> &bull; <a href="#" style="color: gray;">Terms & Conditions</a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



