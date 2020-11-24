<div class="form-group">
  <div class="input-group">
    <input type="text" name="data_search" class="form-control" id="cancelled" placeholder="Search anything from the table...">
    <div class="input-group-append">
      <span class="input-group-text">
        <i class="mdi mdi-magnify-plus mdi-18px"></i>
      </span>
    </div>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-striped table-borderless" id="cancelled-table">
    <thead>
      <tr>
        <th>NO.</th>
        <th>FULL NAME</th>
        <th>PHONE</th>
        <th>BOOKED DATE</th>
        <th>DATE CANCELLED</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $count = 1;
        foreach ( $cancelled as $row ) {
          echo '<tr>';
          echo '<td>'. $count .'</td>';
          echo '<td><img class="rounded-circle img-sm mr-2" src="'. base_url() .'bh-uploads/'. $row->user_photo .'" />'. ucwords( $row->user_fname ) .'</td>';
          echo '<td>'. $row->user_phone .'</td>';
          echo '<td class="text-success"><div class="d-flex flex-column"><span class="mb-2 font-weight-medium">'. date_format ( date_create ( $row->book_date ), 'j M, Y' ) .'</span><small class="text-muted">'. date_format ( date_create ( $row->book_date ), 'H:i:s A' ) .'</small></div></td>';
          echo '<td class="text-danger"><div class="d-flex flex-column"><span class="mb-2 font-weight-medium">'. date_format ( date_create ( $row->book_cancel ), 'j M, Y' ) .'</span><small class="text-muted">'. date_format ( date_create ( $row->book_cancel ), 'H:i:s A' ) .'</small></div></td>';
          echo '</tr>';
          $count++;
        }
        echo '<input type="hidden" value="'. $count .'" class="cancelled-count">';
      ?>
    </tbody>
  </table>
</div>