<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Login extends MY_Controller 
{

	function __construct() {
		parent::__construct();
		
		// Load models
		$this->load->model( array( 'Model_Login', 'Model_Authattempts' ) );
		$this->load->library( array( 'form_validation' ) );
	}

	/**
	 * INDEX PAGE
	 */
	public function index() {

		// Check if the user reach the maximum allowed login attempts.
		// Otherwise user will be redirected to block page.
		intval( $attempt_count = $this->Model_Authattempts->_attempt_check() ); 
		if ( $attempt_count > 3 ) {

			// Redirect to block page
			redirect( base_url( 'login/blocked' ) ); 
		}

		// Add attempts if someone trying to login without a valid session
		if ( $this->session->userdata( 'user_rule' ) != 'administrator' || $this->session->userdata( 'user_rule' ) != 'booker' || $this->session->userdata( 'user_rule' ) == 'user') {

			// Record login attempts
			$this->Model_Authattempts->_attempt_insert( $this->session->userdata( 'user_id' ) );
		}

		// Check if there is existing session.
		if ( $this->session->userdata( 'user_rule' ) == 'administrator' || $this->session->userdata( 'user_rule' ) == 'user' ) {
			
			// Redirect to dashboard page
      redirect( base_url( 'dashboard' ) );
		} elseif ( $this->session->userdata( 'user_rule' ) == 'booker' ) {

			// Redirect to account page
			redirect( base_url( 'account' ) );
		}

		// Login form fields
		$fields = array(
			array(
				'field' => 'user_name',
				'label' => 'username',
				'rules'	=> 'required|trim',
			),
			array(
				'field' => 'user_pass',
				'label' => 'password',
				'rules'	=> 'required|trim',
			),
		);

		$this->form_validation->set_rules( $fields );

		// Check request method
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			
			// Run form validation
			if ( $this->form_validation->run() ) { 

				// Assign values
				if ( $this->input->post( 'user_name' ) && $this->input->post( 'user_pass' ) ) {
					$data = array(
						'username' 	=> $this->input->post( 'user_name' ),
						'user_pass' => $this->input->post( 'user_pass' ),
					);
					
					// Check user if exist in the database
					if ( $this->Model_Login->user_check( $data ) ) {
						redirect( base_url( 'dashboard' ) );
					} else {
						
						// Add login attempts
						$attempt_count = intval( $this->Model_Authattempts->_attempt_check() ); 
						if ( $this->Model_Authattempts->_attempt_insert( $this->input->post( 'user_name' ) ) ) {
							$this->session->set_tempdata( array(
								'alert' => '<strong>Sorry!</strong> login failed. You have <strong>' . ( 4 - $attempt_count ) . '</strong> attempt(s) remaining.',
								'class' => 'danger',
							), NULL, 5 );
						}
					}
				}
			}
		}

		$data['title']  = 'Admin Login';

		// Page templates
		$this->template->set_master_template( 'layouts/layout_site' );
		$this->template->write( 'title', $data['title'] ); 
		$this->template->write_view( 'content', 'view_login', $data );
		$this->template->render();
	}

	/**
	 * BLOCK USER IF TOO MANY ATTEMPTS
	 */
	public function blocked() {
		if ( $this->session->userdata( 'user_id' ) ) {
      redirect( base_url( 'dashboard' ) );
		} else {
			$this->template->set_master_template( 'layouts/layout_site' );
			$this->template->write( 'title', 'Access Blocked' );
			$this->template->write_view( 'content', 'view_blocked' );
			$this->template->render();
		}
	}

	/**
	 * USER SIGNOUT
	 */
	public function signout() {

		// Record log when logging out
		if ( $this->Model_Log->add_log( log_lang( 'login' )['out'] ) ) {

			// Unset session variables
			$session_name  = array( 'user_id', 'user_name', 'user_rule', 'user_photo' );
			foreach ( $session_name as $key ) {
				unset( $_SESSION[ $key ] ); 
			}
			if ( session_destroy() ) {
				redirect( base_url( 'login' ) );
			} 
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

/* End of file Login.php */
/* Location: ./application/modules/login/controllers/Login.php */
