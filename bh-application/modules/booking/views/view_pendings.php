<div class="form-group">
  <div class="input-group">
    <input type="text" name="data_search" class="form-control" id="set-users"
      placeholder="Search anything from the table...">
    <div class="input-group-append">
      <span class="input-group-text">
        <i class="mdi mdi-magnify-plus mdi-18px"></i>
      </span>
    </div>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-striped table-borderless" id="pendings">
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
          echo '<td>'. ucwords( $row->user_fname ) .'</td>';
          echo '<td>'. $row->user_phone .'</td>';
          echo '<td>'. date_format ( date_create ( $row->book_date ), 'j M, Y' ) .'</td>';
          echo '<td>'. date_format ( date_create ( $row->book_arrival ), 'j M, Y' ) .'</td>';
          echo '<td><input type="button" class="confirm-booking" value="Confirm">&nbsp;<input type="button" class="cancel-booking" value="Cancel"></td>';
          echo '</tr>';
          $count++;
        }
      ?>
    </tbody>
  </table>
</div>