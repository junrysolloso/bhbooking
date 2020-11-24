<!-- start of room modal -->
<div id="room_modal" class="modal fade auth theme-one" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body">
        <span><i class="mdi mdi-close-circle icon-lg modal-close-btn" data-dismiss="modal"></i><span>
        <div class="card auto-form-wrapper rounded">
          <div class="card-body">
            <h4 class="card-title">ROOM DETAILS</h4>
            <form action="#" method="post" id="room-update">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="edit_room_name">Room Name</label>
                    <div class="input-group">
                      <input type="hidden" name="edit_room_id">
                      <input type="text" name="edit_room_name" class="form-control" id="edit_room_name" required="">
                      <div class="input-group-append">
                        <span class="input-group-text text-success">
                          <i class="mdi mdi-18px mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group" id="room-status">
                    <label for="edit_room_status">Room Status</label>
                    <div class="input-group">
                      <select type="text" name="edit_room_status" class="form-control select2" id="edit_room_status" data-room-select-id="0" tabindex="-1" aria-hidden="true">
                        <option value="Empty" data-room-select-id="0">Empty</option>
                        <option value="Occupied" data-room-select-id="1">Occupied</option>
                        <option value="Full" data-room-select-id="1">Full</option>
                        <option value="Reserved" data-room-select-id="2">Reserved</option>
                      </select>
                      <div class="input-group-append">
                        <span class="input-group-text text-success">
                          <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="edit_room_equiv">Bedrooms</label>
                    <div class="input-group">
                      <input type="number" name="edit_room_equiv" class="form-control" id="edit_room_equiv" required="" disabled >
                      <div class="input-group-append">
                        <span class="input-group-text text-success">
                          <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="edit_room_rate">Room Monthly Rate</label>
                    <div class="input-group">
                      <input type="number" step="0.01" name="edit_room_rate" class="form-control" id="edit_room_rate" required />
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group" id="select_ref_width">
                    <label for="edit_room_desc">Room Description</label>
                    <div class="input-group">
                      <input type="text" name="edit_room_desc" class="form-control" id="edit_room_desc" required="">
                      <div class="input-group-append">
                        <span class="input-group-text text-success">
                          <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 pt-2">
                  <input type="submit" name="edit_room_submit" value="Update Room" class="btn btn-success submit-btn float-left">
                  <input type="button" name="edit_room_delete" value="Delete Room" class="btn btn-default submit-btn float-left">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end of room modal -->