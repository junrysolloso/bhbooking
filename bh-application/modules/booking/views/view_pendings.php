<div class="form-group">
  <div class="input-group">
    <input type="text" name="data_search" class="form-control" id="pendings" placeholder="Search anything from the table...">
    <div class="input-group-append">
      <span class="input-group-text">
        <i class="mdi mdi-magnify-plus mdi-18px"></i>
      </span>
    </div>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-striped table-borderless" id="pendings-table">
    <thead>
      <tr>
        <th>NO.</th>
        <th>NAME</th>
        <th>PHONE NUMBER</th>
        <th>DATE</th>
        <th>ARRIVAL</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $count = 1;
        foreach ( $pendings as $row ) {
          echo '<tr>';
          echo '<td>'. $count .'</td>';
          echo '<td><img class="rounded-circle img-sm mr-2" src="'. base_url() .'bh-uploads/'. $row->user_photo .'" />'. ucwords( $row->user_fname ) .'</td>';
          echo '<td>'. $row->user_phone .'</td>';
          echo '<td><div class="d-flex flex-column"><span class="mb-2 font-weight-medium">'. date_format ( date_create ( $row->book_date ), 'j M, Y' ) .'</span><small class="text-muted">'. date_format ( date_create ( $row->book_date ), 'H:i:s A' ) .'</small></div></td>';
          echo '<td>'. date_format ( date_create ( $row->book_arrival ), 'j M, Y' ) .'</td>';
          echo '<td><i class="mdi mdi-plus-box-outline mdi-24px text-primary confirm-booking" r-id="'. $row->room_id .'" b-id="'. $row->book_id .'" u-id="'. $row->user_id .'"></i>&nbsp;<i class="mdi mdi-minus-box-outline mdi-24px text-danger cancel-booking" r-id="'. $row->room_id .'" b-id="'. $row->book_id .'" u-id="'. $row->user_id .'"></i></td>';
          echo '</tr>';
          $count++;
        }
      ?>
    </tbody>
  </table>
</div>