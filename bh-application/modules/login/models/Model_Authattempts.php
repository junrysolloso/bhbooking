<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Model_Authattempts extends MY_Model
{
  
  /**
   * CLASS PROPERTIES
   */
  protected $table      = 'tbl_auth_attempts';
  protected $id         = 'auth_id';
  protected $attempts   = 'auth_attempts';
  protected $blocked    = 'auth_date';
  protected $auth_user  = 'auth_user';

  /**
   * INSERT LOGIN ATTEMPTS
   * 
   * @param string $user
   * @return bool
   */
  public function _attempt_insert( $user = '' ) {
    if( $user && ! empty( $user ) ) {
      $data = array(
        $this->auth_user  => $user,
        $this->attempts   => ( $this->_attempt_check() + 1 ),
        $this->blocked    => date('Y-m-d H:i:s'),
      );
      if ( $this->db->insert( $this->table, $data ) ) {
        return true;
      }
    }
  }

  /**
   * COUNT LOGIN ATTEMPTS
   * 
   * @param int $user_id
   * @return int $count
   */
  public function _attempt_check() {
    $this->db->select( 'COUNT(`auth_id`) as `id`' );
    $query = $this->db->get( $this->table );
    if( $query->num_rows() > 0 ) {
      return intval( $query->row()->id );
    } 
  }

  /**
   * CLEAR LOGIN ATTEMPTS
   * 
   * @return bool
   */
  public function _attempt_clear() {
    if( $this->db->truncate( $this->table ) ) {
      return true;
    } 
  }

}

/* End of file Model_Authattempts.php */
/* Location: ./application/modules/login/models/Model_Authattempts.php */
