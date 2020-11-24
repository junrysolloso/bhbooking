<!-- start of month modal -->
<div id="report_month_modal" class="modal fade auth theme-one" role="dialog">
  <div class="modal-dialog" style="width: 40vw;">
    <div class="modal-content">
      <div class="modal-body">
        <span><i class="mdi mdi-close-circle icon-lg modal-close-btn" data-dismiss="modal"></i><span>
        <div class="card auto-form-wrapper rounded">
          <div class="card-body">
            <form action="#" method="post" id="form-report-month">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="report_month">Choose Month</label>
                    <div class="input-group">
                      <select type="text" name="report_month" class="form-control select2" id="report_month" data-room-select-id="0" tabindex="-1" aria-hidden="true">
                        <?php $c = 0; foreach ( $months as $row ) {
                          if ( $row->month != '' ) {
                            echo '<option value="'. strtolower( $row->month ) .'" data-room-select-id="'. $c .'">'. ucwords( $row->month ) .'</option>';
                          }
                          $c++;
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
                <div class="col-12 pt-2">
                  <input type="submit" name="report_month_submit" value="View" class="btn btn-danger submit-btn float-left">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end of month modal -->

<!-- start of year modal -->
<div id="report_year_modal" class="modal fade auth theme-one" role="dialog">
  <div class="modal-dialog" style="width: 40vw;">
    <div class="modal-content">
      <div class="modal-body">
        <span><i class="mdi mdi-close-circle icon-lg modal-close-btn" data-dismiss="modal"></i><span>
        <div class="card auto-form-wrapper rounded">
          <div class="card-body">
            <form action="#" method="post" id="form-report-year">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="report_year">Choose Year</label>
                    <div class="input-group">
                      <input type="hidden" name="report_data">
                      <select type="text" name="report_year" class="form-control select2" id="report_year" data-room-select-id="0" tabindex="-1" aria-hidden="true">
                        <?php $c = 0; foreach ( $years as $row ) {
                          if ( intval( $row->year ) != 0 ) {
                            echo '<option value="'. $row->year .'" data-room-select-id="'. $c .'">'. $row->year .'</option>';
                          }
                          $c++;
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
                <div class="col-12 pt-2">
                  <input type="submit" name="report_year_submit" value="View" class="btn btn-danger submit-btn float-left">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end of year modal -->