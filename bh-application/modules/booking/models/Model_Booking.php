<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Model_Booking extends MY_Model
{
  
  /**
   * CLASS PROPERTIES
   */
  protected $table                 = 'tbl_bookings';
  protected $book_id               = 'book_id';
  protected $book_date             = 'book_date';
  protected $book_arrival          = 'book_arrival';
  protected $book_status           = 'book_status';
  protected $book_cancel           = 'book_cancel';

  protected $relate_rooms          = 'tbl_rooms';
  protected $relate_room_id        = 'room_id';
  protected $relate_room_available = 'room_available';

  protected $relate_user_meta      = 'tbl_user_meta';
  protected $relate_user_id        = 'user_id';

  /**
   * INITIALIZE PARENT
   */
  function __construct() {
    parent:: __construct();
  }

  /**
   * BOOKING ADD
   * @param array $data
   */
  public function booking_add( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {
      if ( $this->db->insert( $this->table, $data ) ) {
        return true;
      }
    }
  }

  /**
   * UPDATE BOOKING STATUS
   */
  public function update_status( $id, $arg ) {
    if ( ! empty( $id ) && ! empty( $arg ) ) {
      
      // Data to update
      if ( $arg == 'pending' ) {
        $data = array(
          $this->book_status => 'active',
        );
      } elseif ( $arg == 'complete' ) {
        $data = array(
          $this->book_status => 'complete',
        );
      } else {
        $data = array(
          $this->book_status => 'cancelled',
          $this->book_cancel => date( 'Y-m-d H:i:s' ),
        );
      }

      // Query
      $this->db->where( $this->book_id, $id );
      if ( $this->db->update( $this->table, $data ) ) {
        return true;
      }
    }
  }

  /**
   * GET BOOKING
   * @param string $arg
   */
  public function get_bookings( $id, $arg ) {
    if ( ! empty( $arg ) ) {

      $this->db->select( '*' );
      
      // Switch arg
      switch ( $arg ) {
        case 'booker':
          $this->db->where( '`tbl_bookings`.`user_id`', $id );
          break;
        case 'pending':
          $this->db->where( $this->book_status, 'pending' );
          break;
        case 'cancelled':
          $this->db->where( $this->book_status, 'cancelled' );
          break;
        case 'active':
          $this->db->where( $this->book_status, 'active' )->limit( 10 );
          break;
        case 'list':
          $this->db->where( '`book_status` !=', 'pending' );
          $this->db->where( '`book_status` !=', 'cancelled' );
          break;
        default:
          break;
      }

      // Join related rable
      $this->join( $this->relate_rooms, '`tbl_bookings`.`room_id`=`tbl_rooms`.`room_id`' );
      $this->join( $this->relate_user_meta, '`tbl_bookings`.`user_id`=`tbl_user_meta`.`user_id`' );
      $this->order_by( $this->book_date, 'DESC' );
      $query = $this->db->get( $this->table );
      
      // Check query
      if ( $query ) {
        return $query->result();
      }
    }
  }

  /**
   * GET IF THEIR IS NEW BOOKING 
   * OR CANCELLED BOOKING
   */
  public function notify( $arg ) {
    if ( ! empty( $arg ) ) {

      // Count id
      $this->db->select('COUNT(`book_id`) AS `count`');

      if ( $arg == 'pending' ) {
        $this->db->where( $this->book_status, 'pending' );
      } else {
        $this->db->where( $this->book_status, 'cancelled' );
      }

      $count = $this->db->get( $this->table )->row()->count;

      if ( isset( $count ) ) {
        return $count;
      }
    }
  }

  /**
   * GET LAST BOOK TIME
   */
  public function last_booking_date( $arg ) {
    if ( ! empty( $arg ) ) {

      $this->db->select('MAX(`book_date`) AS `date`');
      if ( $arg == 'pending' ) {
        $this->db->where( $this->book_status, 'pending' );
      } else {
        $this->db->where( $this->book_status, 'cancelled' );
      }

      $date = $this->db->get( $this->table )->row()->date;

      if ( isset( $date ) ) {
        return $date;
      }
    }
  }

  /**
   * CHECK BOOKING STATUS
   */
  public function check_status( $user_id ) {
    if ( ! empty( $user_id ) ) {
      $query = $this->db->select( '*' )->where( $this->relate_user_id, $user_id )->where( $this->book_status, 'active' )->get( $this->table );
      if ( $query->num_rows() > 0 ) {
        return true;
      }
    }
  }

}

/* End of file Model_Booking.php */
/* Location: ./application/modules/booking/models/Model_Booking.php */
