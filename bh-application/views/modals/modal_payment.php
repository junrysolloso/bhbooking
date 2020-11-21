<!-- start of payment modal -->
<div id="payment_modal" class="modal fade auth theme-one" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body">
        <span><i class="mdi mdi-close-circle icon-lg modal-close-btn" data-dismiss="modal"></i><span>
        <div class="card auto-form-wrapper rounded">
          <div class="card-body">
            <h4 class="card-title">PAYMENT DETAILS</h4>
            <form action="#" method="post" id="form-payment">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="pay_booker">Boarder Name</label>
                    <div class="input-group">
                      <select type="text" name="pay_booker" class="form-control select2" id="pay_booker" data-room-select-id="0" tabindex="-1" aria-hidden="true">
                        <?php foreach ( $list as $row ) {
                          echo '<option value="'. $row->user_id .'" b-id="'. $row->book_id .'" r-id="'. $row->room_id .'" data-room-select-id="'. $row->user_id .'">'. ucwords( $row->user_fname ) .'</option>';
                        }?>
                      </select>
                      <div class="input-group-append">
                        <span class="input-group-text text-success">
                          <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pay_amount">Payment Amount</label>
                    <div class="input-group">
                      <input type="number" step="0.01" name="pay_amount" class="form-control" id="pay_amount" required />
                      <div class="input-group-append">
                        <span class="input-group-text text-success">
                          <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                        </span>
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