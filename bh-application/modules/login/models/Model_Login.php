<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Model_Login extends MY_Model
{

  /**
   * CLASS PROPERTIES
   */
  protected $table      = 'tbl_user_login';
  protected $table_join = 'tbl_user_meta';
  protected $login_name = 'login_name';
  protected $login_pass = 'login_pass';

  function __construct() {
    parent:: __construct();

    $this->load->model( 'Model_Authattempts' );
  }

  /**
   * CHECK USER IF EXIST
   * 
   * @param array $data
   * @return bool
   */
  public function user_check( $data = [] ) {
    if ( ! empty( $data ) && is_array( $data ) ) {

      // Query
      $this->db->select( '*' );
      $this->db->where( $this->login_name, $data['username'] );
      $this->db->where( $this->login_pass, md5( $data['user_pass'] ) );
      $this->db->join( $this->table_join, '`tbl_user_login`.`user_id`=`tbl_user_meta`.`user_id`' );
      $query = $this->db->get( $this->table );

      // Check query
      if( $query ) {
        if ( $query->num_rows() > 0 ) {

          // Values to add to a session
          $data = array(
            'user_id'    => $query->row()->user_id,
            'user_name'  => ucwords( $query->row()->user_fname ),
            'user_rule'  => strtolower( $query->row()->login_level ),
            'user_photo' => $query->row()->user_photo,
          );

          // Clear attempts
          if ( $this->Model_Authattempts->_attempt_clear() ) {

            // Set user data to a session
            $this->session->set_userdata( $data );
            if ( $this->session->userdata( 'user_id' ) ) {
              
              // Record log
              if ( $this->Model_Log->add_log( log_lang( 'login' )['in'] ) ) {
                return true;
              }
            }
          }
        }
      }
    }
  }

}

/* End of file Model_Login.php */
/* Location: ./application/modules/login/models/Model_Login.php */
