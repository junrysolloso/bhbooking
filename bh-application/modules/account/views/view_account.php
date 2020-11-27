<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth multi-step-login theme-one" style="background-image: linear-gradient(140deg, #FDDBE2, #fff);">
      <div class="row w-100">
        <div class="col-md-7 mx-auto">
          <div class="pb-4 mt-5 text-center">
            <img class="profile-image rounded-circle img-lg" src="<?php echo  base_url() ?>bh-uploads/<?php echo $this->session->userdata( 'user_photo' ); ?>" /> 
            <h3 class="pt-2"><?php echo ucwords( 'welcome ' ) . explode( ' ', $this->session->userdata( 'user_name' ) )[0] .'!'; ?></h3>
            <p class="text-muted">You can now navigate to your account page.</p>
            <a href="<?php echo base_url(); ?>login/signout" class="text-warning">Logout</a>
          </div>
          <!-- start content -->
          
          <div class="card auto-form-wrapper rounded mb-5">
            <div class="card-body shadow-sm">

              <ul class="nav nav-tabs tab-solid tab-solid-success" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#booking" aria-selected="true">Booking Details</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#payments" aria-selected="false">Payment Details</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#profile" aria-selected="false">Profile Details</a>
                </li>
                <?php if ( ! $status  ): ?>
                  <li class="nav-item">
                    <a class="nav-link text-success" href="#" id="add-booking"><i class="mdi mdi-plus-circle-outline mdi-24px"></i></a>
                  </li>
                <?php endif; ?>
              </ul>

              <div class="tab-content tab-content-solid">
                <div class="tab-pane fade active show" id="booking" role="tabpanel">
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless" id="booking-table">
                      <thead>
                        <tr>
                          <th>NO.</th>
                          <th>BOOKING DATE</th>
                          <th>ARRIVAL DATE</th>
                          <th>BOOKING STATUS</th>
                          <th>ROOM</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $count = 1;
                          foreach ( $bookings as $row ) {
                            echo '<tr>';
                            echo '<td>'. $count .'</td>';
                            echo '<td class="text-success"><div class="d-flex flex-column"><span class="mb-2 font-weight-medium">'. date_format ( date_create ( $row->book_date ), 'j M, Y' ) .'</span><small class="text-muted">'. date_format ( date_create ( $row->book_date ), 'H:i:s A' ) .'</small></div></td>';
                            echo '<td class="text-info">'. date_format ( date_create ( $row->book_arrival ), 'j M, Y' ) .'</td>';
                            
                            // Show date if cancelled
                            if ( $row->book_status == 'cancelled' ) {
                              echo '<td><div class="d-flex flex-column"><span class="mb-2 font-weight-medium text-danger">'. ucfirst( $row->book_status ) .'</span><small class="text-muted">'. date_format ( date_create ( $row->book_cancel ), 'j M, Y @ H:i:s A' ) .'</small></div></td>';
                            } else {

                              // Add text class
                              if ( $row->book_status == 'pending' ) { 
                                $text_class = 'text-warning'; 
                              } else { 
                                $text_class = 'text-success'; 
                              }

                              echo '<td class="'. $text_class .'">'. ucwords( $row->book_status ) .'</td>';
                            }
                            
                            echo '<td>'. ucwords( $row->room_name ) .'</td>';

                            // Show cancel button otherwise hide
                            if ( $row->book_status == 'pending' ) {
                              echo '<td><span class="text-danger cancel-booking" r-id="'. $row->room_id .'" b-id="'. $row->book_id .'" u-id="'. $row->user_id .'"><i class="mdi mdi-minus-circle-outline"></i> Cancel</span></td>';
                            } else {
                              echo '<td class="text-warning"><i class="mdi mdi-information-outline"></i> Nothing</td>';
                            }

                            echo '</tr>';
                            $count++;
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="tab-pane fade" id="payments" role="tabpanel">
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless" id="payments-table">
                      <thead>
                        <tr>
                          <th>NO.</th>
                          <th>MONTH PAID</th>
                          <th>PAYMENT AMOUNT</th>
                          <th>RECIEVED BY</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $count = 1;
                          foreach ( $payments as $row ) {
                            echo '<tr>';
                            echo '<td>'. $count .'</td>';
                            echo '<td>'. date_format(  date_create( $row->pay_date ), 'Y-m-d @ H:i:s A' ) .'</td>';
                            echo '<td class="text-success">'. number_format( $row->pay_amount, 2 ) .' Pesos</td>';
                            echo '<td>'. ucwords( $row->user_fname ) .'</td>';
                            echo '</tr>';
                            $count++;
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                
                <div class="tab-pane fade" id="profile" role="tabpanel">
                  <?php foreach ( $profile as $row ): ?>
                    <form action="#" method="post">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label for="user_fname">Full Name</label>
                            <div class="input-group">
                              <input type="hidden" name="userinfo_id">
                              <input type="text" name="user_fname" value="<?php echo ucwords( $row->user_fname ); ?>" class="form-control" id="user_fname" disabled />
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="user_email">Email Address</label>
                            <div class="input-group">
                              <input type="text" name="user_email" value="<?php echo $row->user_email; ?>" class="form-control" id="user_email" disabled />
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label for="user_name">User Name</label>
                            <div class="input-group">
                              <input type="text" name="user_name" value="<?php echo ucwords( $row->login_name ); ?>" class="form-control" id="user_name" disabled />
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="user_pass">Password</label>
                            <div class="input-group">
                              <input type="password" name="user_pass" value="<?php echo $row->login_pass; ?>" class="form-control" id="user_pass" disabled />
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group">
                            <label for="user_phone">Phone Number</label>
                            <div class="input-group">
                              <input type="text" name="user_phone" value="<?php echo $row->user_phone; ?>" class="form-control" id="user_phone" disabled />
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="user_add">Permanent Address</label>
                            <div class="input-group">
                              <input type="text" name="user_add" value="<?php echo ucwords( $row->user_add ); ?>" class="form-control" id="user_add" disabled />
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  <i class="mdi mdi-check-circle-outline mdi-18px"></i>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 pt-2">
                          <input type="button" id="account-edit" value="Edit Profile" class="btn btn-danger submit-btn float-right">
                        </div>
                      </div>
                    </form>
                  <?php endforeach; ?>
                </div>
              </div>
              <!-- end content -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>