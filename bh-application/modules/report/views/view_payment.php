<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <style>

    table {
      width: 100% !important;
    }

    table td {
      border: 1px solid #eee;
      padding: 10px 5px;
      margin: 0px;
      text-align: center;
    }

    table th {
      border: 1px solid #eee;
      padding: 10px 5px;
    }

    tfoot td {
      font-weight: 800;
    }

    h2 {
      text-align: center;
    }

  </style>
</head>
<body>
<div class="table-responsive">
  <h2><?php echo strtoupper( $page_title ); ?></h2>
  <table>
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
        $count = 1; $sum = 0;
        foreach ( $payments as $row ) {
          echo '<tr>';
          echo '<td>'. $count .'</td>';
          echo '<td>'. ucwords( $row->user_fname ) .'</td>';
          echo '<td>'. date_format( date_create( $row->pay_date ), 'j M, Y @ H:i:s A' ) .'</td>';
          echo '<td>'. number_format( $row->pay_amount, 2 ) .'</td>';
          echo '</tr>';
          $count++;
          $sum = $sum + $row->pay_amount;
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4"><?php echo strtoupper('Total Amount Collected: ' ) . number_format( $sum, 2 ); ?></td>
      </tr>
    </tfoot>
  </table>
</div>
</body>
</html>