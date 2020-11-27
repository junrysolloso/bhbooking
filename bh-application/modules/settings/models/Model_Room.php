<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Model_Room extends MY_Model
{

  /**
   * CLASS PROPERTIES
   */
  protected $table           = 'tbl_rooms';
  protected $room_id         = 'room_id';
  protected $room_name       = 'room_name';
  protected $room_equiv      = 'room_equiv';
  protected $room_photo      = 'room_photo';
  protected $room_desc       = 'room_desc';
  protected $room_status     = 'room_status';
  protected $room_available  = 'room_available';

  /**
   * CONSTRUCT PARENT
   */
  function __construct() {
    parent:: __construct();
  }

  /**
   * ROOM ADD
   * @param array $data
   */
  public function room_add( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {
      if ( $this->db->insert( $this->table, $data ) ) {
        $this->Model_Log->add_log( log_lang( 'room' )['add'] );
        return $this->room_get();
      }
    }
  } 

  /**
   * ROOM UPDATE
   * @param array $data
   */
  public function room_update( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {

      // Get number of bedrooms
      $this->db->select( '`room_equiv` AS `equiv`' );
      $this->db->where( $this->room_id, $data['room_id'] );
      $ref = $this->db->get( $this->table )->row()->equiv;

      // Get remaining bedrooms
      $this->db->select( '`room_available` AS `avail`' );
      $this->db->where( $this->room_id, $data['room_id'] );
      $rem = $this->db->get( $this->table )->row()->avail;

      // Difference of the old and new number of beds
      $dif = intval( $data['room_equiv'] ) - intval( $ref );

      // Set the value of new number of available beds
      if ( $dif > 0 ) {
        $avail = intval( $rem ) + $dif;
      } elseif ( $dif < 0 ) {
        $avail = $data['room_equiv'];
      } elseif ( $dif == 0 ) {
        $avail = $rem;
      }

      // Data to update
      $updates = array (
        'room_name'       => strtolower( $data['room_name'] ),
        'room_desc'       => strtolower( $data['room_desc'] ),
        'room_rate'       => strtolower( $data['room_rate'] ),
        'room_status'     => strtolower( $data['room_status'] ),
        'room_equiv'      => $data['room_equiv'],
        'room_available'  => $avail,
      );

      // Execute update
      $this->db->where( $this->room_id, $data['room_id'] );
      if ( $this->db->update( $this->table, $updates ) ) {
        $this->Model_Log->add_log( log_lang( 'room' )['update'] );
        return $this->room_get();
      }
    }
  } 

  /**
   * DELETE ROOM
   * @param array $data
   */
  public function room_delete( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {
      $this->db->where( $this->room_id, $data['room_id'] );
      if ( $this->db->delete( $this->table ) ) {
        $this->Model_Log->add_log( log_lang( 'room' )['delete'] );
        return $this->room_get();
      }
    }
  } 

  /**
   * ROOM CHECK
   * @param array $data
   */
  public function room_check( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {
      $this->select( '*' )->where( $this->room_name, $data['value'] );
      $query = $this->db->get( $this->table );
      if ( $query->num_rows() > 0 ) {
        return true;
      }
    }
  }
  
  /**
   * ROOM GET
   * @return array $result
   */
  public function room_get() {
    $this->db->order_by( $this->room_id, 'ASC' );
    $query = $this->db->get( $this->table );
    if ( $query ) {
      return $query->result();
    }
  } 

  /**
   * GET RROM RATE
   * @return id $room_rate
   */
  public function get_room_rate( $room_id ) {
    if ( ! empty( $room_id ) && is_numeric( $room_id ) ) {
      $room_rate = $this->db->select( '`room_rate`' )->where( $this->room_id, $room_id )->get( $this->table )->row()->room_rate;
      if ( $room_rate >  0 ) {
        return $room_rate;
      }
    }
  } 

  /**
   * GET ROOM ID
   */
  public function room_id_get() {

    // Get room id
    $this->db->select( '`room_id` AS `id`' )->where( '`room_available` != ', 0 )->limit( 1 )->order_by( $this->room_id, 'ASC' );
    $this->db->where( '`room_status` !=', 'reserved' );
    $query = $this->db->get( $this->table );
    if ( $query->num_rows() > 0 ) {
      return $query->row()->id;
    }
  }

  /**
   * UPDATE ROOM AVAILABLE
   */
  public function room_update_available( $room_id, $arg )  {
    if ( ! empty( $room_id )  && ! empty( $arg ) ) {

      // Especific query
      if ( $arg == 'cancelled' ) {

        // Get the number of bedrooms
        $beds = $this->db->select( '`room_equiv` AS `equiv`' )->where( $this->room_id, $room_id )->get( $this->table )->row()->equiv;
        
        // Add available room
        if ( $this->db->simple_query( 'UPDATE `tbl_rooms` SET `room_available`=(`room_available` + 1) WHERE `room_id`='.$room_id.' && `room_available` < '.$beds.'' ) ) {
          return true;
        }
      } else {
        
        // Minus available room
        if ( $this->db->simple_query( 'UPDATE `tbl_rooms` SET `room_available`=(`room_available` - 1) WHERE `room_id`='.$room_id.'' ) ) {
          $this->Model_Log->add_log( log_lang( 'room' )['update'] );
          return true;
        }
      }
    }
  }

  /**
   * UPDATE ROOM STATUS
   */
  public function room_update_status( $room_id ) {

    if ( ! empty( $room_id ) ) {

      // Get available beds
      $equiv = $this->db->select( '`room_equiv` AS `equiv`' )->where( $this->room_id, $room_id )->get( $this->table )->row()->equiv;
      $avail = $this->db->select( '`room_available` AS `avail`' )->where( $this->room_id, $room_id )->get( $this->table )->row()->avail;

      // Data to update
      if ( $avail == 0 ) {
        $data = array(
          $this->room_status => 'full',
        );
      } elseif ( $avail == $equiv ) {
        $data = array(
          $this->room_status => 'empty',
        );
      } else {
        $data = array(
          $this->room_status => 'occupied',
        );
      }
      
      $this->db->where( $this->room_id, $room_id );
      if ( $this->db->update( $this->table, $data ) ) {
        $this->Model_Log->add_log( log_lang( 'room' )['update'] );
        return true;
      }
    }
  }

  /**
   * CHECK FOR AVAILABLE ROOMS
   */
  public function room_check_available() {
    $this->select( 'SUM(`room_available`) AS `available`' );
    $this->db->where( '`room_status` !=', 'reserved' );
    $availabe = $this->db->get( $this->table )->row()->available;
    if ( $availabe > 0 ) {
      return $availabe;
    } else {
      return false;
    }
  }

}

/* End of file Model_Room.php */
/* Location: ./application/modules/settings/models/Model_Room.php */
