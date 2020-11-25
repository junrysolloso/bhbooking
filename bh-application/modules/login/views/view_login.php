<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper auth p-0 theme-two">
      <div class="row d-flex align-items-stretch">
        <div class="col-md-4 banner-section d-none d-md-flex align-items-stretch justify-content-center">
          <div class="slide-content bg-1"> </div>
        </div>
        <div class="col-12 col-md-8 h-100 bg-white">
          <div class="auto-form-wrapper d-flex align-items-center justify-content-center flex-column">
            <form action="" method="post">
              <h3 class="mr-auto">Hello! let's get started.</h3>
              <p class="mb-5 mr-auto">Enter your details below.</p>

              <?php if( validation_errors() ): ?>
              <div class="alert alert-fill-danger" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                <strong>Warning!</strong> All fields is required.
              </div>
              <?php endif; ?>

              <?php if( $this->session->tempdata( 'alert' ) ): ?>
              <div class="alert alert-fill-<?php echo $this->session->tempdata( 'class' ); ?>" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                <?php echo $this->session->tempdata( 'alert' ); ?>
              </div>
              <?php endif; ?>
              
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="mdi mdi-account-outline"></i>
                    </span>
                  </div>
                  <input type="text" name="user_name" class="form-control" placeholder="Username">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="mdi mdi-lock-outline"></i>
                    </span>
                  </div>
                  <input type="password" name="user_pass" class="form-control" placeholder="Password">
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-danger submit-btn" style="background-image: linear-gradient(112deg, #f52d91, #f32436);">LOGIN</button>
              </div>
              <div class="wrapper mt-5 text-gray">
                <p class="footer-text"><?php credits( 'co' ); ?></p>
                <ul class="auth-footer text-gray">
                  <li>
                    <a href="javascript:void(0);"><?php credits( 'cr' ); ?></a>
                  </li>
                </ul>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
