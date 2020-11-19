<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth theme-one" style="background-image: linear-gradient(to bottom,#d41459,#911a6c);">
      <div class="row w-100">
        <div class="col-lg-4 mx-auto">
          <?php if( $this->session->tempdata( 'alert' ) ): ?>
            <div class="alert alert-fill-<?php echo $this->session->tempdata( 'class' ); ?>" role="alert">
              <i class="mdi mdi-alert-circle"></i>
              <?php echo $this->session->tempdata( 'alert' ); ?>
            </div>
          <?php endif; ?>
          <div class="card text-center ">
            <div class="card-body">
              <i class="mdi mdi-information-outline text-danger mdi-48px"></i>
              <h2 class="text-center">CLEANUP TABLE(S)</h2>
              <div class="auto-form-wrapper">
                <form action="<?php echo base_url(); ?>setup/clean" method="post">
                  <label for="table_name" class="text-danger mb-4">Proceed with caution. This action cannot be reverted.</label>
                  <div class="form-group">
                    <select name="table_name" id="table_name" class="form-control">
                      <option value="All">All</option>
                      <option value="Authentication">Authentication</option>
                      <option value="Bookings">Bookings</option>
                      <option value="Logs">Logs</option>
                      <option value="Payments">Payments</option>
                      <option value="Rooms">Rooms</option>
                      <option value="Settings">Settings</option>
                      <option value="User">User</option>
                    </select>
                  </div>
                  <div class="form-group pb-2">
                    <button type="submit" class="btn btn-danger submit-btn btn-block">SWEEP DATA</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
