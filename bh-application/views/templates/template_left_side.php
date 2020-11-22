    <!-- start of content wrapper -->
    <div class="content-wrapper container-wrapper-width">
      <!-- start of left sidebar -->
      <div class="sidebar-menu">
        <nav class="nav">
          <div class="nav-item">
            <a href="<?php echo base_url(); ?>dashboard" class="nav-link">
              <i class="menu-icons mdi mdi-signal-cellular-outline"></i><span class="menu-title">Dashboard</span>
            </a>
          </div>
          <div class="nav-item nav-category">BOOKINGS</div>
          <div class="nav-item">
            <a href="<?php echo base_url(); ?>booking/pendings" class="nav-link">
              <i class="menu-icons mdi mdi-plus-box-outline"></i><span class="menu-title">Pendings</span>
            </a>
          </div>
          <div class="nav-item">
            <a href="<?php echo base_url(); ?>booking/cancelled" class="nav-link">
              <i class="menu-icons mdi mdi-file-cancel-outline"></i><span class="menu-title">Cancelled</span>
            </a>
          </div>
          <div class="nav-item nav-category">BOARDERS</div>
          <div class="nav-item">
            <a href="<?php echo base_url(); ?>boarder/list" class="nav-link">
              <i class="menu-icons mdi mdi-view-list"></i><span class="menu-title">List</span>
            </a>
          </div>
          <div class="nav-item">
            <a href="#" id="payment" class="nav-link">
              <i class="menu-icons mdi mdi-subtitles-outline"></i><span class="menu-title">Pay</span>
            </a>
          </div>
          <!-- <div class="nav-item nav-category">REPORTS</div>
          <div class="nav-item">
            <a href="<?php echo base_url(); ?>reports/boarders" class="nav-link">
              <i class="menu-icons mdi mdi-account-circle-outline"></i><span class="menu-title">Boarders</span>
            </a>
          </div>
          <div class="nav-item">
            <a href="<?php echo base_url(); ?>reports/dues" class="nav-link">
              <i class="menu-icons mdi mdi-briefcase-account-outline"></i><span class="menu-title">Dues</span>
            </a>
          </div>
          <div class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#resources-dropdown" aria-expanded="false" aria-controls="dashboard-dropdown">
              <i class="menu-icons mdi mdi-content-duplicate"></i>
              <span class="menu-title">Resources</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="resources-dropdown">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>reports/revenue">Revenue Reports</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>reports/annual">Annual Reports</a>
                </li>
              </ul>
            </div>
          </div> -->
          <div class="nav-item nav-category">GLOBAL</div>
          <div class="nav-item">
            <a href="<?php echo base_url(); ?>settings" class="nav-link">
              <i class="menu-icons mdi mdi-settings-outline"></i><span class="menu-title">Settings</span>
            </a>
          </div>
          <div class="nav-item">
            <a href="#" id="db-backup" class="nav-link">
              <i class="menu-icons mdi mdi-database-export"></i><span class="menu-title">Backup</span>
            </a>
          </div>
        </nav>

        <div class="sidebar-footer">
          <p class="mb-0">© Alex Boarding House</p>
          <small class="text-muted d-block mt-2">Created with ❤ by Dinagat Coders</small>
        </div>
      </div>
      <!-- end of left sidebar -->

      <!-- start of content area -->
      <div class="content-area">
        <div class="page-header">
          <h4 class="page-title"><?php echo ucfirst( strtolower( $title ) ); ?></h4>
        </div>
        <!-- start of content inner -->
        <div class="content-area-inner">
          <!-- start fo card -->
          <div class="card w-100 auth theme-one">
            <!-- start of card body -->
            <div class="card-body">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item text-muted">
                    <a class="text-muted" href="#"><i class="mdi mdi-home mr-2"></i>Home</a>
                  </li>
                  <li class="breadcrumb-item active text-muted" aria-current="page"><?php echo ucfirst( strtolower( $title ) ); ?>
                  </li>
                </ol>
              </nav>
              <!-- start of form wrapper -->
              <div class="auto-form-wrapper">