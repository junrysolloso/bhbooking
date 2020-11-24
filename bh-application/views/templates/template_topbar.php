<!-- start of main body container -->
<div class="container-scroller">
  <!-- start of page body wrapper -->
  <div class="container-fluid page-body-wrapper">
    <!-- start of main panel -->
    <div class="main-panel" style="background: #fff; ">
      <!-- start of hero banner -->
      <div class="hero-banner">
        <div class="navbar">
          <div class="container-wrapper-width">
            <div class="row w-100">
              <div class="d-none d-md-block col-md-8 navbar-col order-md-0">
                <ul class="nav">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="mdi mdi-home"></i>
                      <span class="title-text">Alex Boarding House</span>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-10 col-md-4 navbar-col order-md-3">
                <ul class="nav navbar-nav-right ml-auto">
                  <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                      <i class="mdi mdi-bell-alert"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                      <a href="<?php echo base_url(); ?>booking/pendings" class="dropdown-item preview-item py-3">
                        <div class="preview-thumbnail">
                          <i class="mdi mdi-bell-alert-outline m-auto text-info"></i>
                        </div>
                        <div class="preview-item-content">
                          <h6 class="preview-subject font-weight-normal text-dark mb-1" id="book-count">New Booking</h6>
                          <p class="font-weight-light text-info small-text mb-0" id="book-count-time">0 day(s) 00hr 00min</p>
                        </div>
                      </a>
                      <a href="<?php echo base_url(); ?>booking/cancelled" class="dropdown-item preview-item py-3">
                        <div class="preview-thumbnail">
                          <i class="mdi mdi-bell-alert-outline m-auto text-danger"></i>
                        </div>
                        <div class="preview-item-content">
                          <h6 class="preview-subject font-weight-normal text-dark mb-1" id="cancel-count">Cancelled Booking</h6>
                          <p class="font-weight-light text-danger small-text mb-0" id="cancel-count-time">0 day(s) 00hr 00min</p>
                        </div>
                      </a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
                      <i class="mdi mdi-chat-processing"></i>
                    </a>
                  </li>
                  <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                    <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                      aria-expanded="false">
                      <img class="img-xs rounded-circle" src="<?php echo base_url(); ?>bh-uploads/<?php echo $this->session->userdata( 'user_photo' ); ?>" alt="Profile image">
                      <span class="profile-text"><?php echo $this->session->userdata( 'user_name' ); ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                      <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="<?php echo base_url(); ?>bh-uploads/<?php echo $this->session->userdata( 'user_photo' ); ?>" alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold"><?php echo $this->session->userdata( 'user_name' ); ?></p>
                        <p class="font-weight-light text-muted mb-0"><?php echo $this->session->userdata( 'user_rule' ); ?></p>
                      </div>
                      <a href="<?php echo base_url(); ?>login/signout" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary"></i>Sign Out</a>
                    </div>
                  </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-md-none align-self-center" type="button">
                  <span class="mdi mdi-menu"></span>
                </button>
                <button class="chat-toggler d-md-none align-self-center" type="button">
                  <span class="mdi mdi-dots-vertical"></span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end of hero banner -->