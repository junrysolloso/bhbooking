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
                      <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                      <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary"></i> Activity</a>
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