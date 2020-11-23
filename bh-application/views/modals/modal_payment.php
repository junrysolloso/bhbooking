<!-- start of payment modal -->
<div id="payment_modal" class="modal fade auth theme-one" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body">
        <span><i class="mdi mdi-close-circle icon-lg modal-close-btn" data-dismiss="modal"></i><span>
        <div class="card auto-form-wrapper rounded">
          <div class="card-body">
            <h4 class="card-title">PAYMENT DETAILS<a class="nav-link text-success" href="#" id="add-pay-btn" style="display: inline;"><i class="mdi mdi-plus-circle-outline mdi-24px"></i></a></h4>
            <form action="#" method="post" id="form-payment">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="pay_booker">Boarder Name</label>
                    <div class="input-group">
                      <select type="text" name="pay_booker" class="form-control select2" id="pay_booker" data-room-select-id="0" tabindex="-1" aria-hidden="true">
                        <?php foreach ( $list as $row ) {
                          echo '<option value="'. $row->user_id .'" b-id="'. $row->book_id .'" r-id="'. $row->room_id .'" r-rate="'. $row->room_rate .'"  data-room-select-id="'. $row->user_id .'">'. ucwords( $row->user_fname ) .'</option>';
                        }?>
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
                    <label for="pay_room_rate">Room Rate</label>
                    <div class="input-group">
                      <input type="number" name="pay_room_rate" class="form-control" id="pay_room_rate" disabled />
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12" id="add-pay-container">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="pay_amount">Amount</label>
                        <div class="input-group">
                          <input type="number" step="0.01" name="pay_amount[]" class="form-control" id="pay_amount" required />
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
                        <label for="pay_date">Month</label>
                        <div class="input-group">
                          <input type="text" name="pay_date[]" class="form-control" id="pay_date" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="yyyy-mm-dd" required im-insert="false" />
                          <div class="input-group-append">
                            <span class="input-group-text">
                              <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 pt-2">
                  <input type="submit" name="pay_submit" value="Save Payment" class="btn btn-success submit-btn float-left">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end of payment modal -->