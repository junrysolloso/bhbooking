<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller
{

  function __construct() {
    parent:: __construct();

    $this->load->model( 'Model_Room' );
    $this->load->model( 'Model_User_Meta' );
    $this->load->model( 'Model_Payment' );
    $this->load->model( 'Model_User_Login' );
    $this->load->model( 'booking/Model_Booking' );
  }

  /**
   * INDEX PAGE
   */
  public function index() {

    Sess::admin();

    // Data to pass to view
    $data['title']  = 'Settings';
    $data['class']  = 'settings';
    $data['rooms']  = $this->Model_Room->room_get();
    $data['users']  = $this->Model_User_Login->user_get();
    $data['logs']   = $this->Model_Log->get_logs();
    $data['recent'] = $this->Model_Booking->get_bookings( NULL, 'active' );
    $data['list']   = $this->Model_Booking->get_bookings( NULL, 'list' );
  
    // Load template parts
    $this->template->set_master_template( 'layouts/layout_admin' );
    $this->template->write( 'title', $data['title'] );
    $this->template->write( 'body_class', $data['class'] );

    $this->template->write_view( 'content', 'templates/template_topbar', $data );
    $this->template->write_view( 'content', 'templates/template_left_side' );
    $this->template->write_view( 'content', 'view_settings' );
    $this->template->write_view( 'content', 'templates/template_right_side' );
    $this->template->write_view( 'content', 'templates/template_footer' );

    // Modals
    $this->template->write_view( 'content', 'modals/modal_room' );
    $this->template->write_view( 'content', 'modals/modal_user' );
    $this->template->write_view( 'content', 'modals/modal_payment' );

    // Additional JS
    $this->template->add_js( 'bh-assets/js/pages/page_room.js' );
    $this->template->add_js( 'bh-assets/js/pages/page_user.js' );
		$this->template->render();
  }

  /**
   * ROOM REQUEST HANDLER
   */
  public function room() {
    
    // Check Server Request
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

      // Add Room
      if ( $this->input->post( 'room_add' ) ) {
        $data = array (
          'room_id'         => $this->input->post( 'room_id' ),
          'room_equiv'      => $this->input->post( 'room_equiv' ),
          'room_name'       => strtolower( $this->input->post( 'room_name' ) ),
          'room_desc'       => strtolower( $this->input->post( 'room_desc' ) ),
          'room_rate'       => $this->input->post( 'room_rate' ),
          'room_photo'      => 'room.jpg',
          'room_status'     => strtolower( 'empty' ),
          'room_available'  => $this->input->post( 'room_equiv' ),
        );

        // Clean empty array
        $data = clean_array( $data );

        // Add Room and return the save data
        $response = $this->Model_Room->room_add( $data );
        if ( $response ) {
          
          // Send Response and exit
          $this->_response( $response );
        }
      }

      // Update Room
      if ( $this->input->post( 'room_update' ) ) {
        $data = array (
          'room_id'     => $this->input->post( 'room_id' ),
          'room_name'   => $this->input->post( 'room_name' ),
          'room_equiv'  => $this->input->post( 'room_equiv' ),
          'room_status' => $this->input->post( 'room_status' ),
          'room_desc'   => $this->input->post( 'room_desc' ),
          'room_rate'   => $this->input->post( 'room_rate' ),
        );

        // Clean empty array  
        $data = clean_array( $data );

        // Update room and return the updated data
        $response = $this->Model_Room->room_update( $data );
        if ( $response ) {
          
          // Send Response and exit
          $this->_response( $response );
        }
      }

      // Delete Room
      if ( $this->input->post( 'room_delete' ) ) {
        $data = array (
          'room_id' => $this->input->post( 'room_id' ),
        );

        // Clean empty array
        $data = clean_array( $data );

        // Update room and return the updated data
        $response = $this->Model_Room->room_delete( $data );
        if ( $response ) {
          
          // Send Response and exit
          $this->_response( $response );
        }
      }

      // Check Room
      if ( $this->input->post( 'room_check' ) ) {
        $data = array (
          'value' => strtolower( $this->input->post( 'value' ) ),
        );

        // Clean empty array
        $data = clean_array( $data );

        // Check username if already exist
        if ( ! $this->Model_Room->room_check( $data ) ) {
          $data = array(
            'msg' => 'none',
          );

          // Send response
          $this->_response( $data );
        }
      }
    } else {
      $this->_response( array( 'message' => 'Unknown request.' ) );
    }
  }

  /**
   * USER REQUEST HANDLER
   */
  public function user() {
    
    // Check Server Request
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

      // User Add
      if ( $this->input->post( 'user_add' ) ) {

        // Data for user meta
        $meta = array (
          'user_fname'  => strtolower( $this->input->post( 'user_fname' ) ),
          'user_email'  => $this->input->post( 'user_email' ),
          'user_phone'  => $this->input->post( 'user_phone' ),
          'user_photo'  => 'avatar.jpg',
          'user_add'    => strtolower( 'dinagat islands' ),
          'user_status' => strtolower( 'active' ),
        );

        // Data for user login
        $login = array(
          'login_name'  => strtolower( $this->input->post( 'user_name' ) ),
          'login_pass'  => $this->input->post( 'user_pass' ),
          'login_level' => strtolower( $this->input->post( 'user_level' ) ),
        );

        // Clean empty array
        $meta  = clean_array( $meta );
        $login = clean_array( $login );

        // Add user and return the save data
        if ( $this->Model_User_Meta->user_meta_add( $meta ) ) {
          $response = $this->Model_User_Login->user_login_add( $login );
          if ( $response ) {
          
            // Send Response and exit
            $this->_response( $response );
          }
        }
      }

      // User Update
      if ( $this->input->post( 'user_update' ) ) {

        // Check user address
        if ( empty( $this->input->post( 'u_user_add' ) ) ) {
          $address = 'dinagat islands';
        } else {
          $address = $this->input->post( 'u_user_add' );
        }

        // Check user status
        if ( empty( $this->input->post( 'u_user_status' ) ) ) {
          $status = 'pending';
        } else {
          $status = $this->input->post( 'u_user_status' );
        }

        // Data for user meta
        $meta = array (
          'user_id'     => $this->input->post( 'u_user_id' ),
          'user_email'  => $this->input->post( 'u_user_email' ),
          'user_phone'  => $this->input->post( 'u_user_phone' ),
          'user_fname'  => strtolower( $this->input->post( 'u_user_fname' ) ),
          'user_status' => strtolower( $status ),
          'user_add'    => strtolower( $address ),
        );

        // Data for user login
        $login = array(
          'user_id'     => $this->input->post( 'u_user_id' ),
          'login_name'  => strtolower( $this->input->post( 'u_user_name' ) ),
          'login_pass'  => $this->input->post( 'u_user_pass' ),
          'login_level' => strtolower( $this->input->post( 'u_user_level' ) ),
        );

        // Clean empty array
        $meta  = clean_array( $meta );
        $login = clean_array( $login );

        // Add user and return the save data
        if ( $this->Model_User_Meta->user_meta_update( $meta ) ) {
          $response = $this->Model_User_Login->user_login_update( $login );
          if ( $response ) {
          
            // Send Response and exit
            $this->_response( $response );
          }
        }
      }
      
      // Delete User
      if ( $this->input->post( 'user_delete' ) ) {
        $data = array (
          'user_id' => $this->input->post( 'user_id' ),
        );

        // Clean empty array
        $data = clean_array( $data );

        // Delete user data
        if ( $this->Model_User_Meta->user_meta_delete( $data ) ) {
          $response = $this->Model_User_Login->user_login_delete( $data );
          if ( $response ) {
          
            // Send Response and exit
            $this->_response( $response );
          }
        }
      }

      // Check User
      if ( $this->input->post( 'user_check' ) ) {
        $data = array (
          'value' => strtolower( $this->input->post( 'value' ) ),
        );
        
        // Clean empty array
        $data = clean_array( $data );

        // If user
        if ( strtolower( $this->input->post( 'user_check' ) == 'user' ) ) {
          
          // Check username if already exist
          if ( ! $this->Model_User_Login->user_check( $data ) ) {
            $data = array(
              'msg' => 'none',
            );

            // Send response
            $this->_response( $data );
          }
        } else {

          // Check email if already exist
          if ( ! $this->Model_User_Meta->email_check( $data ) ) {
            $data = array(
              'msg' => 'none',
            );

            // Send response
            $this->_response( $data );
          }
        }
      }

      // Update user status
      if ( $this->input->post( 'mark_uid' ) ) {
        if ( ! empty( $this->input->post( 'mark_uid' ) ) ) {

          // Update user status
          $this->Model_User_Meta->update_status( $this->input->post( 'mark_uid' ), 'complete' );
          if ( ! empty( $this->input->post( 'mark_bid' ) ) ) {

            // Update booking status
            $this->Model_Booking->update_status( $this->input->post( 'mark_bid' ), 'complete' );
          }
        }
      }
    } else {
      $this->_response( array( 'message' => 'Unknown request.' ) );
    }
  }

  /**
   * ADD PAYMENT
   */
  public function add_payment() {

    // Check Server Request
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

      // User Add
      if ( $this->input->post( 'amount' ) ) {
        
        $flag    = false;
        $amounts = array();

        // Get post values
        $room_id = $this->input->post( 'room_id' );
        $user_id = $this->input->post( 'user_id' );
        $amount  = intval( $this->input->post( 'amount' ) );

        // Get room rate
        $room_rate = $this->Model_Room->get_room_rate( $room_id );

        if ( $amount < $room_rate ) {

          // Get latest amount paid
          $latest_amount = $this->Model_Payment->get_latest_amount( $user_id, $room_rate );

          // Check if their is a latest payment that is less that the room rate
          if ( ! empty( $latest_amount ) ) {
            if ( intval( $latest_amount[0]->amount ) < $room_rate ) {

              $amount  = ( $latest_amount[0]->amount + $amount );

              if ( $this->Model_Payment->update_payment( $latest_amount[0]->pay_id, $amount ) ) {
                $this->_response( array( 'msg' => 'updated' ) );
              }
            } 
          } else {
            $this->_response( array( 'msg' => 'no-latest' ) );
          }
        } elseif ( $amount == $room_rate ) {

          // Values to insert
          $data = array(
            'pay_amount'   => $amount,
            'pay_date'     => date( 'Y-m-d H:i:s' ),
            'pay_reciever' => $this->session->userdata( 'user_id' ),
            'user_id'      => $this->input->post( 'user_id' ),
            'book_id'      => $this->input->post( 'book_id' ),
          );

          if ( $this->Model_Payment->add_payment( $data ) ) {
            $this->_response( array( 'msg' => 'added' ) );
          } else {
            $this->_response( array( 'msg' => 'error' ) );
          }
        } else {
          
          // Get latest amount paid
          $latest_amount = $this->Model_Payment->get_latest_amount( $user_id, $room_rate );

          // Check if their is a latest payment that is less that the room rate
          if ( ! empty( $latest_amount ) ) {
            if ( intval( $latest_amount[0]->amount ) < $room_rate ) {

              if ( $this->Model_Payment->update_payment( $latest_amount[0]->pay_id, $room_rate ) ) {

                // Minus the latest amount if the booker has a latest payment
                // which is not equal to room rate
                $l_diff = $room_rate - intval( $latest_amount[0]->amount );

                // Set the new amount
                $amount = ( $amount - $l_diff );
                
              }
            } 
          }

          // Number of months to pay
          $months = ceil( $amount / $room_rate );
          
          if ( $months > 1 ) {
            
            // More that 1 month
            for ( $i=1; $i < $months; $i++ ) { 
              array_push( $amounts, $room_rate );
            }

            if ( ( $amount % $room_rate ) == 0 ) {
              for ($i=0; $i < $months; $i++) { 
                array_push( $amounts, $room_rate );
              }
            } else {

              // Remaining amount
              array_push( $amounts, ( $amount % $room_rate ) );
            }
          } else {

            // Only 1 month
            array_push( $amounts, $room_rate );
          }

          // Insert payment
          for ( $i=0; $i < $months; $i++ ) { 

            // Values to insert
            $data = array(
              'pay_amount'   => $amounts[ $i ],
              'pay_date'     => date( 'Y-m-d H:i:s' ),
              'pay_reciever' => $this->session->userdata( 'user_id' ),
              'user_id'      => $this->input->post( 'user_id' ),
              'book_id'      => $this->input->post( 'book_id' ),
            );

            if ( $this->Model_Payment->add_payment( $data ) ) {
              $flag = true;
            }
          }

          if ( $flag ) {
            $this->_response( array( 'msg' => 'added' ) );
          } else {
            $this->_response( array( 'msg' => 'error' ) );
          }
        }
      }
    } else {
      $this->_response( array( 'message' => 'Unknown request.' ) );
    }
  }

  /**
   * GET PAYMENTS
   */
  public function list_payments() {

    // Check Server Request
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

      // User Add
      if ( $this->input->post( 'user_id' ) ) {

        $payments = $this->Model_Payment->get_payments( $this->input->post( 'user_id' ), 'booker' );
        if( ! empty( $payments ) ) {
          $this->_response( $payments );
        }
      }
    } else {
      $this->_response( array( 'message' => 'Unknown request.' ) );
    }
  }

  /**
   * NOTIFIER
   */
  public function notifier() {
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
      if ( $this->input->post( 'n_status' ) && ! empty( $this->input->post( 'n_status' ) ) ) {
        $count = $this->Model_Booking->notify( $this->input->post( 'n_status' ) );
        
        // Interval between today and the booking date
        $t_date = date_create( date( 'Y-m-d H:i:s' ) );
        $b_date = date_create( $this->Model_Booking->last_booking_date( $this->input->post( 'n_status' ) ) );
        $i_date = date_diff( $t_date, $b_date );
        
        // Return response
        if ( isset( $count ) ) {
          $this->_response( array( 'count' => $count, 'time' => $i_date ) );
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

/* End of file Settings.php */
/* Location: ./application/modules/settings/controllers/Settings.php */
