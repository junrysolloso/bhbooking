              </div>
              <!-- end of form wrapper -->
            </div>
            <!-- end of card body -->
          </div>
          <!-- end of card -->
        </div>
        <!-- end of content inner -->

        <!-- start of right sidebar -->
        <div class="content-aside-right">
          <h4 class="card-title text-muted">Recent Boarders</h4>
          <ul class="activity-lists">
            <?php
              foreach ( $recent as $row ) {
                echo '<li class="activity-list">';
                echo '<img class="profile-image rounded-circle img-sm" src="'. base_url() .'bh-uploads/'. $row->user_photo .'" />';
                echo '<div class="activity-content">';
                echo '<p class="profile-image-name">'. ucwords( $row->user_fname ) .'</p>';
                echo '<p class="activity-text">'. $row->book_arrival .'</p>';
                echo '<p class="activity-time">'. $row->book_date .'</p>';
                echo '</div>';
                echo '</li>';
              }
            ?>
          </ul>
        </div>
        <!-- end of right sidebar -->
      </div>
      <!-- end of content area -->