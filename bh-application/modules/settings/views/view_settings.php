<!-- tab navigation -->
<ul class="nav nav-tabs tab-solid tab-solid-success" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#room" aria-selected="true">Room Details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#user" aria-selected="false">User Details</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#logs" aria-selected="false">Log Details</a>
  </li>
</ul>
<!-- end of tab navigation -->

<!-- start of tab content -->
<div class="tab-content tab-content-solid">
  <!-- start of room tab -->
  <div class="tab-pane fade show active" id="room" role="tabpanel">
    <form action="#" method="post" id="form-room">
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="room_name">Room Name</label>
            <div class="input-group">
              <input type="hidden" name="room_id">
              <input type="text" name="room_name" class="form-control" id="room_name" required />
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
            <label for="room_equiv">Bedrooms</label>
            <div class="input-group">
              <input type="number" name="room_equiv" class="form-control" id="room_equiv" required />
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
            <label for="room_rate">Room Monthly Rate</label>
            <div class="input-group">
              <input type="number" step="0.01" name="room_rate" class="form-control" id="room_rate" required />
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="room_desc">Room Description</label>
            <div class="input-group">
              <input type="text" name="room_desc" class="form-control" id="room_desc" required />
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 pt-2">
          <input type="submit" name="room_submit" value="Add Room" class="btn btn-danger submit-btn float-right">
        </div>
      </div>
    </form>

    <div class="table-responsive border-top mt-4">
      <table class="table table-striped table-borderless" id="room-table">
        <thead>
          <tr>
            <th>NO.</th>
            <th>NAME</th>
            <th>SIZE</th>
            <th>STATUS</th>
            <th>VIEW</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $count = 1;
            foreach ( $rooms as $row ) {
              echo '<tr>';
              echo '<td>'. $count .'</td>';
              echo '<td>'. ucwords( $row->room_name .' ( '. $row->room_status .' )') .'</td>';
              echo '<td class="text-info">'. $row->room_equiv . ' Bedroom(s)' .'</td>';

              if (  $row->room_available == 0 ) {

                // Full
                echo '<td class="text-danger">'. $row->room_available .' Bed(s) Availabe' .'</td>';
              } elseif ( $row->room_available == $row->room_equiv ) {

                // Empty
                echo '<td class="text-success">'. $row->room_available .' Bed(s) Availabe' .'</td>';
              } else {

                // Occupied
                echo '<td class="text-warning">'. $row->room_available .' Bed(s) Availabe' .'</td>';
              }
              
              echo '<td><span class="room-details" r-id="'. $row->room_id .'" r-rate="'. $row->room_rate .'" r-name="'. ucwords( $row->room_name ) .'" r-desc="'. ucwords( $row->room_desc ) .'" r-equiv="'. $row->room_equiv .'" r-status="'. ucwords( $row->room_status ) .'" ><i class="mdi mdi-eye mdi-18px"></i> View</span></td>';
              echo '</tr>';
              $count++;
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- end of room tab -->

  <!-- start of user tab -->
  <div class="tab-pane fade" id="user" role="tabpanel">
    <form action="#" method="post" id="form-user-add">
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="user_fname">Full Name</label>
            <div class="input-group">
              <input type="hidden" name="user_id">
              <input type="text" name="user_fname" class="form-control" id="user_fname" required="">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="user_email">Email Address</label>
            <div class="input-group">
              <input type="text" name="user_email" class="form-control" id="user_email" required="">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="user_phone">Phone Number</label>
            <div class="input-group">
              <input type="text" name="user_phone" class="form-control" id="user_phone" required="">
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
            <label for="user_name">User Name</label>
            <div class="input-group">
              <input type="text" name="user_name" class="form-control" id="user_name" required="">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="user_pass">Password</label>
            <div class="input-group">
              <input type="password" name="user_pass" min="6" max="8" class="form-control" id="user_pass" required="">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="user_pcon">Confirm Password</label>
            <div class="input-group">
              <input type="password" name="user_pcon" min="6" max="8" class="form-control" id="user_pcon" required="">
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
            <label for="user_level">User Level</label>
            <div class="input-group">
              <select type="text" name="user_level" class="form-control select2" id="user_level" data-room-select-id="1"
                tabindex="-1" aria-hidden="true" required>
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
          <input type="submit" name="user_submit" value="Add User" class="btn btn-danger submit-btn float-right">
        </div>
      </div>
    </form>

    <div class="table-responsive border-top mt-4">
      <table class="table table-striped table-borderless" id="user-table">
        <thead>
          <tr>
            <th>FULL NAME</th>
            <th>PHONE</th>
            <th>USER LEVEL</th>
            <th>USERNAME</th>
            <th>VIEW</th>
          </tr>
        </thead>
        <tbody>
          <?php
              foreach ( $users as $row ) {
                echo '<tr>';
                echo '<td><img class="profile-image rounded-circle img-sm" src="'. base_url() .'bh-uploads/'. $row->user_photo .'"> '. ucwords( $row->user_fname ) .'</td>';
                echo '<td>'. $row->user_phone .'</td>';
                echo '<td class="text-warning">'. $row->login_level .'</td>';
                echo '<td class="text-info">'. ucwords( $row->login_name ) .'</td>';
                echo '<td><span class="user-details" u-id="'. $row->user_id .'" u-fname="'. ucwords( $row->user_fname ) .'" u-phone="'. $row->user_phone .'" u-email="'. $row->user_email .'" u-name="'. ucfirst( $row->login_name ) .'" u-status="'. ucwords( $row->user_status ) .'" u-level="'. ucwords( $row->login_level ) .'" ><i class="mdi mdi-eye mdi-18px"></i> View</span></td>';
                echo '</tr>';
              }
            ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- end of user tab -->

  <!-- start of log tab -->
  <div class="tab-pane fade" id="logs" role="tabpanel">
    <div class="form-group">
      <div class="input-group">
        <input type="text" name="data_search" class="form-control" id="logs" placeholder="Search anything from the table...">
        <div class="input-group-append">
          <span class="input-group-text">
            <i class="mdi mdi-magnify-plus mdi-18px"></i>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-borderless" id="logs-table">
        <thead>
          <tr>
            <th>NO.</th>
            <th>USERNAME</th>
            <th>DATE AND TIME</th>
            <th>ACTIVITY</th>
          </tr>
        </thead>
        <tbody>
          <?php
              $count = 1;
              foreach ( $logs as $row ) {
                echo '<tr>';
                echo '<td>'. $count .'</td>';
                echo '<td>'. ucwords( $row->login_name ) .'</td>';
                echo '<td class="text-info">'. date_format( date_create ( $row->log_date ), 'Y-m-d @ H:i:s A' ) .'</td>';
                echo '<td class="text-success">'. ucwords ( $row->log_task ) .'</td>';
                echo '</tr>';
                $count++;
              }
            ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- end of log tab -->
</div>
<!-- end of tab content -->