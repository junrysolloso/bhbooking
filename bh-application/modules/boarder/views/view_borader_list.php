<div class="form-group">
  <div class="input-group">
    <input type="text" name="data_search" class="form-control" id="list" placeholder="Search anything from the table...">
    <div class="input-group-append">
      <span class="input-group-text">
        <i class="mdi mdi-magnify-plus mdi-18px"></i>
      </span>
    </div>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-striped table-borderless" id="list-table">
    <thead>
      <tr>
        <th>NO.</th>
        <th>FULL NAME</th>
        <th>PHONE</th>
        <th>BOOKED DATE</th>
        <th>DETAILS</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $count = 1;
        foreach ( $list as $row ) {
          echo '<tr>';
          echo '<td>'. $count .'</td>';
          echo '<td><img class="rounded-circle img-sm mr-2" src="'. base_url() .'bh-uploads/'. $row->user_photo .'" />'. ucwords( $row->user_fname ) .'</td>';
          echo '<td>'. $row->user_phone .'</td>';
          echo '<td class="text-success"><div class="d-flex flex-column"><span class="mb-2 font-weight-medium">'. date_format ( date_create ( $row->book_date ), 'j M, Y' ) .'</span><small class="text-muted">'. date_format ( date_create ( $row->book_date ), 'H:i:s A' ) .'</small></div></td>';
          echo '<td><span class="user-details" u-id="'. $row->user_id .'"  b-fname="'. ucwords( $row->user_fname ) .'" b-phone="'. $row->user_phone .'" b-email="'. $row->user_email .'" b-photo="'. $row->user_photo .'" b-status="'. ucwords( $row->user_status ) .'" b-address="'. ucwords( $row->user_add ) .'" b-room="'. ucwords( $row->room_name ) .'" b-arrival="'. date_format ( date_create ( $row->book_arrival ), 'l F d, Y' ) .'" b-date="'. date_format ( date_create ( $row->book_date ), 'l F d, Y @ H:i:s A' ) .'"><i class="mdi mdi-eye mdi-18px"></i> View</span></td>';
          echo '</tr>';
          $count++;
        }
      ?>
    </tbody>
  </table>
</div>