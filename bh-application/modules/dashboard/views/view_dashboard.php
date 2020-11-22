<div class="row">
  <div class="col-12 border-bottom pb-4">

    <?php
      for ( $i=0; $i < 7; $i++ ) { 
        echo '<input type="hidden" class="g-labels" value="'. $labels[ $i ] .'">';
        echo '<input type="hidden" class="g-totals" value="'. $totals[ $i ] .'">';
      }
    ?>

    <canvas id="mixed-chart" height="800" style="display: block; height: 800px; width: 1732px;" width="1558"
      class="chartjs-render-monitor"></canvas>
    <div class="mr-5" id="mixed-chart-legend"></div>
  </div>
  <div class="col-12 pt-4">
    <div class="d-flex justify-content-between align-items-center pb-4">
      <h4 class="card-title mb-0 text-muted">Recent Payments</h4>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-borderless" id="recent-pays-table">
        <thead>
          <tr>
            <th>NO.</th>
            <th>FULL NAME</th>
            <th>DATE PAID</th>
            <th>AMOUNT</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $count = 1;
            foreach ( $payments as $row ) {
              echo '<tr>';
              echo '<td>'. $count .'</td>';
              echo '<td class="font-weight-medium"><img class="rounded-circle img-sm mr-2" src="'. base_url() .'bh-uploads/'. $row->user_photo .'">'. ucwords( $row->user_fname ) .'</td>';
              echo '<td>'. date_format( date_create( $row->pay_date ), 'j M, Y @ H:i:s A' ) .'</td>';
              echo '<td class="text-success">₱'. number_format( $row->pay_amount, 2 ) .'</td>';
              echo '</tr>';
              $count++;
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>