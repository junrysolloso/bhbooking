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
  <table class="table">
    <thead>
      <tr>
        <th>NO.</th>
        <th>FULL NAME</th>
        <th>PHONE NUMBER</th>
        <th>STATUS</th>
        <th>DATE STARTED</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $count = 1;
        foreach ( $list as $row ) {
          echo '<tr>';
          echo '<td>'. $count .'</td>';
          echo '<td>'. ucwords( $row->user_fname ) .'</td>';
          echo '<td>'. $row->user_phone .'</td>';

          if ( $row->user_status == 'active' ) {
            echo '<td><div class="d-flex align-items-center"><div class="border-indicator border-success mr-2"></div>'. ucfirst( $row->user_status ) .'</div></td>';
          } else {
            echo '<td><div class="d-flex align-items-center"><div class="border-indicator border-danger mr-2"></div>'. ucfirst( $row->user_status ) .'</div></td>';
          }

          echo '<td>'. date_format ( date_create ( $row->book_arrival ), 'j M, Y' ) .'</td>';
          echo '</tr>';
          $count++;
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5"><?php echo strtoupper('Total Number of Boarders: ' ) . ( $count - 1 ); ?></td>
      </tr>
    </tfoot>
  </table>
</div>
</body>
</html>