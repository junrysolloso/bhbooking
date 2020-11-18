    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1" style="background-image: linear-gradient(to bottom,#d41459,#911a6c);">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <h2 class="text-center mb-4 text-white">TRUNCATE TABLE</h2>

              <?php if( $this->session->tempdata( 'alert' ) ): ?>
                <div class="alert alert-fill-<?php echo $this->session->tempdata( 'class' ); ?>" role="alert">
                  <i class="mdi mdi-alert-circle"></i>
                  <?php echo $this->session->tempdata( 'alert' ); ?>
                </div>
              <?php endif; ?>

              <div class="auto-form-wrapper">
                <form action="<?php echo base_url(); ?>setup/clean" method="post">
                  <label for="table_name">Select table to truncate.</label>
                  <div class="form-group">
                    <select name="table_name" id="table_name" class="form-control">
                      <option value="All">All</option>
                      <option value="Unit Convert">Unit Convert</option>
                      <option value="Unit">Unit</option>
                      <option value="Sub Category">Sub Category</option>
                      <option value="Sales Info">Sales Info</option>
                      <option value="Sales">Sales</option>
                      <option value="Orders">Orders</option>
                      <option value="Order Inventory">Order Inventory</option>
                      <option value="Order Details">Order Details</option>
                      <option value="Order Details Expiry">Order Details Expiry</option>
                      <option value="User">User</option>
                      <option value="Damage Items">Damage Items</option>
                      <option value="Items">Items</option>
                      <option value="Inventory">Inventory</option>
                      <option value="Category">Category</option>
                      <option value="Log">Log</option>
                    </select>
                  </div>
                  <div class="form-group pb-2">
                    <button type="submit" class="btn btn-danger submit-btn btn-block">TRUNCATE TABLE</button>
                  </div>
                </form>
                <form action="<?php echo base_url(); ?>setup/generate" method="post">
                  <div class="form-group pb-2">
                    <input name="generate" type="submit" value="Generate Sales Data" class="btn btn-primary submit-btn btn-block" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
