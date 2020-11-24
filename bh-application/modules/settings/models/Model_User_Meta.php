<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Model_User_Meta extends MY_Model
{

  /**
   * CLASS PROPERTIES
   */
  protected $table        = 'tbl_user_meta';
  protected $user_id      = 'user_id';
  protected $user_fname   = 'user_fname';
  protected $user_phone   = 'user_phone';
  protected $user_email   = 'user_email';
  protected $user_add     = 'user_add';
  protected $user_photo   = 'user_photo';
  protected $user_status  = 'user_status';

  protected $relate_login = 'tbl_user_login';

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
  public function user_meta_add( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {

      // Data to be inserted
      $data = array(
        $this->user_fname   => $data['user_fname'],
        $this->user_phone   => $data['user_phone'],
        $this->user_email   => $data['user_email'],
        $this->user_add     => $data['user_add'],
        $this->user_photo   => $data['user_photo'],
        $this->user_status  => $data['user_status'],
      );

      // Add to database
      if ( $this->db->insert( $this->table, $data ) ) {
        return true;
      }
    }
  } 

  /**
   * UPDATE USER
   * @param array $data
   */
  public function user_meta_update( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {
      
      // Data to update
      $updates = array (
        $this->user_email   => $data['user_email'],
        $this->user_phone   => $data['user_phone'],
        $this->user_fname   => $data['user_fname'],
        $this->user_status  => $data['user_status'],
        $this->user_add     => $data['user_add'],
      );

      // Update user meta
      $this->db->where( $this->user_id, $data['user_id'] );
      if ( $this->db->update( $this->table, $updates ) ) {
        return true;
      }
    }
  } 

  /**
   * UPDATE USER STATUS
   */
  public function update_status( $id = 0, $arg ) {
    if ( ! empty( $id ) && ! empty( $arg ) ) {
      
      // Data to update
      if ( $arg == 'pending' ) {
        $data = array(
          $this->user_status => 'active',
        );
      } elseif ( $arg == 'complete' ) {
        $data = array(
          $this->user_status => 'complete',
        );
      } else {
        $data = array(
          $this->user_status => 'cancelled',
        );
      }

      // Query
      $this->db->where( $this->user_id, $id );
      if ( $this->db->update( $this->table, $data ) ) {
        return true;
      }
    }
  }

  /**
   * DELETE USER META
   * @param array $data
   */
  public function user_meta_delete( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {
      $this->db->where( $this->user_id, $data['user_id'] );
      if ( $this->db->delete( $this->table ) ) {
        return true;
      }
    }
  } 

  /**
   * GET USER ID
   */
  public function user_meta_get_id() {
    $this->db->select( 'MAX(`user_id`) AS `id`' );
    $query = $this->db->get( $this->table );
    if ( $query->num_rows() > 0 ) {
      return $query->row()->id;
    }
  }

  /**
   * EMAIL CHECK
   * @param array $data
   */
  public function email_check( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {
      $this->select( '*' )->where( $this->user_email, $data['value'] );
      $query = $this->db->get( $this->table );
      if ( $query->num_rows() > 0 ) {
        return true;
      }
    }
  }

  /**
   * GET USER DETAILS
   */
  public function get_user_details( $id ) {
    if ( ! empty( $id ) ) {
      $this->select( '*' )->where( '`tbl_user_meta`.`user_id`', $id );
      $this->db->join( $this->relate_login, '`tbl_user_meta`.`user_id`=`tbl_user_login`.`user_id`' );
      $query = $this->db->get( $this->table );

      if ( $query ) {
        return $query->result();
      }
    }
  }

}

/* End of file Model_User.php */
/* Location: ./application/modules/settings/models/Model_User.php */
