<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends MY_Controller
{

  function __construct() {
    parent:: __construct(); 

    // Load models
    $this->load->model( 'Model_Booking' );
    $this->load->model( 'settings/Model_Payment' );
    $this->load->model( 'settings/Model_Room' );
    $this->load->model( 'settings/Model_User_Meta' );
    $this->load->model( 'settings/Model_User_Login' );
  }

	/**
	 * INDEX PAGE
	 */
  public function index() {

    $data['title']      = 'Booking';
		$data['body_class'] = 'booking';

		$this->template->set_master_template( 'layouts/layout_site' );
		$this->template->write( 'title', $data['title'] ); 
		$this->template->write_view( 'content', 'view_booking', $data );
		$this->template->add_js( 'bh-assets/js/pages/page_register.js' );
		$this->template->render();

  }

	/**
	 * PENDING BOOKING PAGE
	 */
  public function pendings() {

    Sess::admin();

    $data['title']    = 'Pending Bookings';
    $data['class']    = 'pending';
    $data['pendings'] = $this->Model_Booking->get_bookings( NULL, 'pending' );
    $data['recent']   = $this->Model_Booking->get_bookings( NULL, 'active' );
    $data['list']     = $this->Model_Booking->get_bookings( NULL, 'list' );

    // Load template parts
    $this->template->set_master_template( 'layouts/layout_admin' );
    $this->template->write( 'title', $data['title'] );
    $this->template->write( 'body_class', $data['class'] );

    $this->template->write_view( 'content', 'templates/template_topbar', $data );
    $this->template->write_view( 'content', 'templates/template_left_side' );
    $this->template->write_view( 'content', 'view_pendings' );
    $this->template->write_view( 'content', 'templates/template_right_side' );
    $this->template->write_view( 'content', 'templates/template_footer' );

    // Modals
    $this->template->write_view( 'content', 'modals/modal_payment' );

    // Add JS 
    $this->template->add_js( 'bh-assets/js/pages/page_booking.js' );
		$this->template->render();
  }

  /**
   * CANCELLED BOOKING PAGE
   */
  public function cancelled() {

    Sess::admin();

    $data['title']     = 'Cancelled Bookings';
    $data['class']     = 'cancelled';
    $data['cancelled'] = $this->Model_Booking->get_bookings( NULL, 'cancelled' );
    $data['recent']    = $this->Model_Booking->get_bookings( NULL, 'active' );
    $data['list']      = $this->Model_Booking->get_bookings( NULL, 'list' );

    // Load template parts
    $this->template->set_master_template( 'layouts/layout_admin' );
    $this->template->write( 'title', $data['title'] );
    $this->template->write( 'body_class', $data['class'] );

    $this->template->write_view( 'content', 'templates/template_topbar', $data );
    $this->template->write_view( 'content', 'templates/template_left_side' );
    $this->template->write_view( 'content', 'view_cancelled' );
    $this->template->write_view( 'content', 'templates/template_right_side' );
    $this->template->write_view( 'content', 'templates/template_footer' );

    // Modals
    $this->template->write_view( 'content', 'modals/modal_payment' );

		$this->template->render();
  }

  /**
   * ROOM
   */
  public function room() {

    // Check server request method
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
      
      // Check which request
      if ( $this->input->post( 'check_available' ) ) {
        
        // Check available rooms
        $room_count = $this->Model_Room->room_check_available();
        if ( $room_count ) {
          $this->_response( array( 'beds' => $room_count ) );
        } else {
          $this->_response( array( 'beds' => 0 ) );
        }
      }
    } else {
      $this->_response( array( 'message' => 'Unknown request.' ) );
    }
  }

  /**
   * CONFIRM BOOKING
   */
  public function update_status() {

    // Check server request method
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
  
      // Check which request
      if ( $this->input->post( 'p_book_id' ) ) {
        
        // Get values from post
        $room_id = $this->input->post( 'p_room_id' );
        $book_id = $this->input->post( 'p_book_id' );
        $user_id = $this->input->post( 'p_user_id' );

        // Peroform updates
        if ( $this->Model_Booking->update_status( $book_id, 'pending' ) ) {
          if ( $this->Model_User_Meta->update_status( $user_id, 'pending' ) ) {

            // Log
            $this->Model_Log->add_log( log_lang( 'booking' )['confirm'] );

            // response
            $this->_response( $this->Model_Booking->get_bookings( NULL, 'pending' ) );
          }
        }
      }

      // Check which request
      if ( $this->input->post( 'c_book_id' ) ) {
  
        // Get values from post
        $room_id = $this->input->post( 'c_room_id' );
        $book_id = $this->input->post( 'c_book_id' );
        $user_id = $this->input->post( 'c_user_id' );

        // Peroform updates
        if ( $this->Model_Booking->update_status( $book_id, 'cancelled' ) ) {
          if ( $this->Model_User_Meta->update_status( $user_id, 'cancelled' ) ) {

            // Add back the bedroom in room available
            if ( $this->Model_Room->room_update_available( $room_id, 'cancelled' ) ) {

              // Update room status
              if ( $this->Model_Room->room_update_status( $room_id ) ) {

                // Log
                $this->Model_Log->add_log( log_lang( 'booking' )['cancel'] );

                // Response
                $this->_response( $this->Model_Booking->get_bookings( NULL, 'pending' ) );
              }
            }
          }
        }
      }
    } else {
      $this->_response( array( 'message' => 'Unknown request.' ) );
    }
  }

  /**
   * ADD BOOKING
   */
  public function add_booking() {

    // Check Server Request
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
      if ( $this->input->post( 'book' ) ) {

        // Get data from the post
        $data = $this->input->post( 'book' );

        // Count the number of bookers
        $bookers = count( $data[0][0] );

        // Booker details
        $booker  = array();
        $counter = 0;
        $flag    = false; 

        // Add all booker details
        for ( $i = 0; $i < $bookers; $i++ ) { 

          $user_fname   = $data[0][0][ $i ];
          $user_phone   = $data[0][1][ $i ];
          $user_email   = $data[0][2][ $i ];
          $user_address = $data[0][3][ $i ];
          $user_arrival = $data[0][4][ $i ];
    
          $login_name   = $data[1][0][ $i ];
          $login_pass   = $data[1][1][ $i ];

          // Data for user meta
          $meta = array (
            'user_fname'  => strtolower( $user_fname ),
            'user_email'  => $user_email,
            'user_phone'  => $user_phone,
            'user_photo'  => 'avatar.jpg',
            'user_add'    => strtolower( $user_address ),
            'user_status' => strtolower( 'pending' ),
          );

          // Data for user login
          $login = array(
            'login_name'  => strtolower( $login_name ),
            'login_pass'  => $login_pass,
            'login_level' => strtolower( 'booker' ),
          );

          // Clean empty array
          $meta  = clean_array( $meta );
          $login = clean_array( $login );

          // Add book
          if ( $this->Model_User_Meta->user_meta_add( $meta ) ) {
            if ( $this->Model_User_Login->user_login_add( $login ) ) {
               
              $room_id = $this->Model_Room->room_id_get();
              $user_id = $this->Model_User_Meta->user_meta_get_id();

              // Booking data
              $booking = array(
                'book_date'     => date( 'Y-m-d H:i:s' ),
                'book_arrival'  => $user_arrival,
                'book_status'   => 'pending',
                'room_id'       => $room_id,
                'user_id'       => $user_id,
              );
              
              // Insert booking
              if ( $this->Model_Booking->booking_add( $booking ) ) {

                // Update room available
                if ( $this->Model_Room->room_update_available( $room_id, 'minus' ) ) {

                  // Update room status
                  if ( $this->Model_Room->room_update_status( $room_id ) ) {
                    $flag = true;
                  }
                }
              }
            }
          }
        }

        // Check flag the return response
        if ( $flag ) {  
          $this->_response( array( 'msg' => 'Booking successful.' ) );
        }
      } 
    } else {
      $this->_response( array( 'message' => 'Unknown request.' ) );
    }
  }

  /**
   * INDIVIDUAL BOOKING
   */
  public function book_me() {

     // Check Server Request
     if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
      if ( $this->input->post( 'user_id' ) ) {

        // Get room id
        $room_id = $this->Model_Room->room_id_get();

        // Get post values
        $data = array(
          'book_date'     => date( 'Y-m-d H:i:s' ),
          'book_arrival'  => $this->input->post( 'arrival' ),
          'book_status'   => 'pending',
          'room_id'       => $room_id,
          'user_id'       => $this->input->post( 'user_id' ),
        );

        // Insert booking
        if ( $this->Model_Booking->booking_add( $data ) ) {

          // Update room available
          if ( $this->Model_Room->room_update_available( $room_id, 'minus' ) ) {

            // Update room status
            if ( $this->Model_Room->room_update_status( $room_id ) ) {

              // Send response
              $this->_response( array( 'msg' => 'Booking successful.' ) );
            }
          }
        }
      }
    } else {
      $this->_response( array( 'message' => 'Unknown request.' ) );
    }
  }

  /**
   * SERVER RESPONSE
   * @param array $data
   */
  private function _response( $data ) {
    
    // Response with JSON format data
    header( 'content-type: application/json' );
    exit( json_encode( $data ) );
  }

}

/* End of file Bookings.php */
/* Location: ./application/modules/booking/controllers/Booking.php */
