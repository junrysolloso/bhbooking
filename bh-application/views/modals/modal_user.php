<!-- start of user update modal -->
<div id="user_modal" class="modal fade auth theme-one" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body">
        <span><i class="mdi mdi-close-circle icon-lg modal-close-btn" data-dismiss="modal"></i><span>
        <div class="card auto-form-wrapper rounded">
          <div class="card-body">
            <h4 class="card-title">USER DETAILS</h4>
            <form action="#" method="post" id="form-user-update">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="edit_user_fname">Full Name</label>
                    <div class="input-group">
                      <input type="hidden" name="edit_user_id">
                      <input type="text" name="edit_user_fname" class="form-control" id="edit_user_fname" required="">
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
                      <input type="text" name="edit_user_email" class="form-control" id="edit_user_email" required="">
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
                      <input type="text" name="edit_user_phone" class="form-control" id="edit_user_phone" required="">
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
                      <input type="text" name="edit_user_name" class="form-control" id="edit_user_name" readonly required="">
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
                    <label for="edit_user_status">User Status</label>
                    <div class="input-group">
                      <select type="text" name="edit_user_status" min="6" max="8" class="form-control select2" id="edit_user_status" data-room-select-id="1" tabindex="-1" aria-hidden="true" required>
                        <option value="" data-room-select-id="0">Select</option>  
                        <option value="Active" data-room-select-id="1">Active</option>
                        <option value="Inactive" data-room-select-id="2">Inactive</option>
                      </select>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="edit_user_level">User Level</label>
                    <div class="input-group">
                      <select type="text" name="edit_user_level" min="6" max="8" class="form-control select2" id="edit_user_level" data-room-select-id="1" tabindex="-1" aria-hidden="true" required>
                        <option value="" data-room-select-id="0">Select</option>  
                        <option value="User" data-room-select-id="1">User</option>
                        <option value="Administrator" data-room-select-id="2">Administrator</option>
                      </select>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 pt-2">
                  <input type="submit" name="edit_user_submit" value="Update User" class="btn btn-danger submit-btn float-left">
                  <input type="button" name="edit_user_delete" value="Delete User" class="btn btn-default submit-btn float-left">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end of user update modal -->