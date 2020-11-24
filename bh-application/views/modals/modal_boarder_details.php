<!-- start of boarder details modal -->
<div id="boarder_details" class="modal fade auth theme-one" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <span><i class="mdi mdi-close-circle icon-lg modal-close-btn" data-dismiss="modal"></i><span>
        <div class="card auto-form-wrapper rounded">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <h4 class="card-title">BOARDER DETAILS</h4>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="booker_fname">Full Name</label>
                  <div class="input-group">
                    <input type="text" name="booker_fname" class="form-control" id="booker_fname" disabled />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="booker_email">Email Address</label>
                  <div class="input-group">
                    <input type="text" name="booker_email" class="form-control" id="booker_email" disabled />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="booker_phone">Phone Number</label>
                  <div class="input-group">
                    <input type="text" name="booker_phone" class="form-control" id="booker_phone" disabled />
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
                  <label for="booker_room">Room Name</label>
                  <div class="input-group">
                    <input type="text" name="booker_room" class="form-control" id="booker_room" disabled />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="booker_date">Booking Date</label>
                  <div class="input-group">
                    <input type="text" name="booker_date" class="form-control" id="booker_date" disabled />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="booker_arrival">Booking Arrival</label>
                  <div class="input-group">
                    <input type="text" name="booker_arrival" class="form-control" id="booker_arrival" disabled />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group" style="margin-bottom: 0px;">
                  <label for="booker_add">Permanent Address</label>
                  <div class="input-group">
                    <input type="text" name="booker_add" class="form-control" id="booker_add" disabled />
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="table-responsive mt-auto">
                  <table class="table table-striped table-borderless" id="booker-payments-table">
                    <thead>
                      <tr>
                        <th>NO.</th>
                        <th>MONTH PAID</th>
                        <th>PAYMENT AMOUNT</th>
                        <th>RECIEVED BY</th>
                      </tr>
                    </thead>
                    <tbody id="payments-content"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end of boarder details modal -->