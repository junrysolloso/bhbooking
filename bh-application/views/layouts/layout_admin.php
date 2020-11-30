<?php defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' ); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>bh-uploads/dinagat-coders-icon.png" />

    <!-- Required CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>bh-assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>bh-assets/vendors/css/vendor.bundle.base.css" />

    <!-- Plugins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>bh-assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>bh-assets/vendors/select2/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>bh-assets/vendors/jquery-toast-plugin/jquery.toast.min.css" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>bh-assets/css/style-main.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>bh-assets/css/style.min.css" />
    
    <!-- Additional CSS -->
    <?php echo $_styles; ?>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>bh-assets/css/admin.css" />
  </head>
  <body class="<?php echo $body_class; ?>">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>" />
    <?php echo $content; ?>

    <!-- Required JS -->
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/vendors/js/vendor.bundle.base.min.js"></script>

    <!-- Plugins JS -->
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/vendors/inputmask/jquery.inputmask.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/vendors/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/vendors/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/js/helper_dateformat.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/js/helper_nav.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/js/helper_toast.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/js/helper_notify.js"></script>

    <!-- 
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/js/helper_form_validation.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/vendors/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/vendors/daterangepicker/daterangepicker.min.js"></script> 
    -->

    <!-- Custom JS -->
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/js/helper_datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/js/helper_table.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bh-assets/js/helper_action.js"></script>

    <!-- Additional JS -->
    <?php echo $_scripts; ?>
  </body>
</html> 
