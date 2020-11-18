<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Model_User_Login extends MY_Model
{

  /**
   * CLASS PROPERTIES
   */
  protected $table        = 'tbl_user_login';
  protected $user_id      = 'user_id';
  protected $login_name   = 'login_name';
  protected $login_pass   = 'login_pass';
  protected $login_level  = 'login_level';

  protected $relate_meta  = 'tbl_user_meta';

  /**
   * CONSTRUCT PARENT
   */
  function __construct() {
    parent:: __construct();
  }

  /**
   * ADD USER
   * @param array $data
   */
  public function user_login_add( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {

      // Get max user id on user meta table
      $user_id = $this->db->select( 'MAX(`user_id`) AS id' )->get( $this->relate_meta )->row()->id;

      // Data to be added
      $data = array(
        $this->user_id      => $user_id,
        $this->login_name   => $data['login_name'],
        $this->login_pass   => md5( $data['login_pass'] ),
        $this->login_level  => $data['login_level'],
      );
      
      // Add to database
      if ( $this->db->insert( $this->table, $data ) ) {
        $this->Model_Log->add_log( log_lang( 'user' )['add'] );
        return $this->user_get();
      }
    }
  } 

  /**
   * UPDATE USER
   * @param array $data
   */
  public function user_login_update( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {

      // Data to update
      $updates = array (
        $this->login_name   => $data['login_name'],
        $this->login_pass   => md5( $data['login_pass'] ),
        $this->login_level  => $data['login_level'],
      );

      // Update user login
      $this->db->where( $this->user_id, $data['user_id'] );
      if ( $this->db->update( $this->table, $updates ) ) {
        $this->Model_Log->add_log( log_lang( 'user' )['update'] );
        return $this->user_get();
      }
    }
  } 

  /**
   * DELETE USER
   * @param array $data
   */
  public function user_login_delete( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {
      $this->db->where( $this->user_id, $data['user_id'] );
      if ( $this->db->delete( $this->table ) ) {
        $this->Model_Log->add_log( log_lang( 'user' )['delete'] );
        return $this->user_get();
      }
    }
  } 

  /**
   * USER CHECK
   * @param array $data
   */
  public function user_check( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {
      $this->select( '*' )->where( $this->login_name, $data['value'] );
      $query = $this->db->get( $this->table );
      if ( $query->num_rows() > 0 ) {
        return true;
      }
    }
  }
  
  /**
   * USER GET
   * @return array $result
   */
  public function user_get() {
    $this->db->order_by( '`tbl_user_meta`.`user_id`', 'ASC' );
    $this->db->join( $this->relate_meta, '`tbl_user_login`.`user_id`=`tbl_user_meta`.`user_id`' );
    $this->db->where( '`login_level` !=', 'booker' );
    $query = $this->db->get( $this->table );
    if ( $query ) {
      return $query->result();
    }
  } 

}

/* End of file Model_User.php */
/* Location: ./application/modules/settings/models/Model_User.php */
