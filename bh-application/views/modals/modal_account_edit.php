<!-- start of booker profile modal -->
<div id="account_modal" class="modal fade auth theme-one" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <span><i class="mdi mdi-close-circle icon-lg modal-close-btn" data-dismiss="modal"></i><span>
        <div class="card auto-form-wrapper rounded">
          <div class="card-body">
            <h4 class="card-title">PROFILE DETAILS</h4>
            <?php foreach ( $profile as $row ): ?>
              <form action="#" method="post" id="form-account-update">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="edit_user_fname">Full Name</label>
                      <div class="input-group">
                        <input type="hidden" name="edit_user_id" value="<?php echo $row->user_id; ?>">
                        <input type="text" name="edit_user_fname" value="<?php echo ucwords( $row->user_fname ); ?>" class="form-control" id="edit_user_fname" required />
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="edit_user_email">Email Address</label>
                      <div class="input-group">
                        <input type="text" name="edit_user_email" value="<?php echo $row->user_email; ?>" class="form-control" id="edit_user_email" required />
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="edit_user_phone">Phone Number</label>
                      <div class="input-group">
                        <input type="text" name="edit_user_phone"  value="<?php echo $row->user_phone; ?>" class="form-control" id="edit_user_phone" required />
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="edit_user_name">User Name</label>
                      <div class="input-group">
                        <input type="text" name="edit_user_name" value="<?php echo ucwords( $row->login_name ); ?>" class="form-control" id="edit_user_name" readonly required />
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="edit_user_pass">Password</label>
                      <div class="input-group">
                        <input type="password" name="edit_user_pass" class="form-control" id="edit_user_pass" required="">
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="edit_user_pcon">Confirm Password</label>
                      <div class="input-group">
                        <input type="password" name="edit_user_pcon" class="form-control" id="edit_user_pcon" required="">
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="edit_user_add">Permanent Address</label>
                      <div class="input-group">
                        <input type="text" name="edit_user_add" value="<?php echo ucwords( $row->user_add ); ?>" class="form-control" id="edit_user_add" required />
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 pt-2">
                    <input type="submit" name="edit_user_submit" value="Update Profile" class="btn btn-danger submit-btn float-left">
                  </div>
                </div>
              </form>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end of booker profile modal -->