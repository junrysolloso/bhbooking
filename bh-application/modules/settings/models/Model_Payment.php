<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Model_Payment extends MY_Model
{

  /**
   * CLASS PROPERTIES
   */
  protected $table            = 'tbl_payments';
  protected $pay_amount       = 'pay_amount';
  protected $pay_date         = 'pay_date';
  protected $pay_reciever     = 'pay_reciever';
  protected $user_id          = 'user_id';
  protected $book_id          = 'book_id';
  protected $pay_id           = 'pay_id';

  protected $relate_user_meta = 'tbl_user_meta';
  protected $relate_user_id   = 'user_id';

  function __construct() {
    parent:: __construct();
  }

  /**
   * ADD PAYMENT
   */
  public function add_payment( $data = [] ) {
    if ( is_array( $data ) && count( $data ) > 0 ) {
      if ( $this->db->insert( $this->table, $data ) ) {
        $this->Model_Log->add_log( log_lang( 'payment' )['add'] );
        return true;
      }
    }
  }

  /**
   * GET PAYMENT
   */
  public function get_payments( $id, $arg ) {
    if ( ! empty( $arg ) ) {

      switch ( $arg ) {
        case 'booker':

          // Booker
          $this->db->select( '`pay_amount`, `pay_date`, `pay_reciever`, `user_fname`' )->where( '`tbl_payments`.`user_id`', $id );
          $this->db->join( $this->relate_user_meta, '`tbl_payments`.`pay_reciever`=`tbl_user_meta`.`user_id`' );
          break;
        case 'all':

          // All
          $this->db->select( '*' )->limit( 40 );
          $this->db->join( $this->relate_user_meta, '`tbl_payments`.`user_id`=`tbl_user_meta`.`user_id`' );
          break;
        default:
          break;
      }
      
      $this->db->order_by( $this->pay_date, 'DESC' );
      $query = $this->db->get( $this->table );

      if( $query ) {
        return $query->result();
      }
    }
  }

  /**
   * GET YEARLY PAYMENT
   */
  public function get_yearly_total() {

    $years  = array();
    $totals = array();
    $data   = array();

    $t_year = intval( date('y') );
    for ($i=0; $i < 7; $i++) { 
      array_push( $years, ('20'. ( $t_year - $i ) ) );
    }

    $years = array_reverse( $years );

    foreach ( $years as $year ) {
      $this->select( 'SUM(`pay_amount`) as `total`' )->where( 'DATE_FORMAT(`pay_date`, "%Y") =', $year );
      $query = $this->db->get( $this->table );
      
      if ( $query ) {
        if ( intval( $query->row()->total ) == 0 ) {
          array_push( $totals, '0.00' );
        } else {
          array_push( $totals, $query->row()->total );
        }
      }
    }

    array_push( $data, $years );
    array_push( $data, $totals );

    return $data;
  }

  /**
   * GET LATEST PAYMENT AMOUNT
   */
  public function get_latest_amount( $user_id, $room_rate ) {
    if ( ! empty( $user_id ) && is_numeric( $user_id ) ) {

      $this->db->select( '`pay_amount` AS `amount`, `pay_id`' )->where( $this->user_id, $user_id )->where( '`pay_amount` <', $room_rate );
      $query = $this->db->get( $this->table );

      if ( $query ) {
        return $query->result();
      }
    }
  }

  /**
   * UPDATE USER PAYMENT
   */
  public function update_payment( $pay_id, $room_rate ) {

    $data = array(
      $this->pay_amount => $room_rate,
    );

    // Execute update
    $this->db->where( $this->pay_id, $pay_id );
    if ( $this->db->update( $this->table, $data ) ) {
      $this->Model_Log->add_log( log_lang( 'payment' )['update'] );
      return true;
    }
  }

}

/* End of file Model_Payment.php */
/* Location: ./application/modules/settings/models/Model_Payment.php */