<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller
{

  function __construct() {
    parent:: __construct(); 

    $this->load->model( 'Model_Room' );
    $this->load->model( 'Model_User_Meta' );
    $this->load->model( 'Model_User_Login' );
  }

  /**
   * INDEX PAGE
   */
  public function index() {
    
    // Check session
		if ( ! sesscheck() ) {
			redirect( base_url( 'login' ) );
		}

    // Data to pass to view
    $data['title'] = 'Settings';
    $data['class'] = 'settings';
    $data['rooms'] = $this->Model_Room->room_get();
    $data['users'] = $this->Model_User_Login->user_get();
    $data['logs']  = $this->Model_Log->get_logs();
  
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
      $this->_redirect_user();
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

        // Check username if already exist
        if ( ! $this->Model_User_Login->user_check( $data ) ) {
          $data = array(
            'msg' => 'none',
          );

          // Send response
          $this->_response( $data );
        }
      }
    } else {
      $this->_redirect_user();
    }
  }

  /**
   * SERVER RESPONSE
   * @param array $data
   */
  public function _response( $data ) {
    
    // Response with JSON format data
    header( 'content-type: application/json' );
    exit( json_encode( $data ) );
  }

  /**
   * REDIRECT VISITOR
   */
  private function _redirect_user() {

    // Redirect visitor if request is not specified
    redirect( base_url( 'login' ) );
  }

}

/* End of file Settings.php */
/* Location: ./application/modules/settings/controllers/Settings.php */
