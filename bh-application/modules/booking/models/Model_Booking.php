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
        default:
          break;
      }

      // Join related rable
      $this->join( $this->relate_rooms, '`tbl_bookings`.`room_id`=`tbl_rooms`.`room_id`' );
      $this->join( $this->relate_user_meta, '`tbl_bookings`.`user_id`=`tbl_user_meta`.`user_id`' );
      $this->order_by( $this->book_date, 'ASC' );
      $query = $this->db->get( $this->table );
      
      // Check query
      if ( $query ) {
        return $query->result();
      }
    }
  }


}

/* End of file Model_Booking.php */
/* Location: ./application/modules/booking/models/Model_Booking.php */
