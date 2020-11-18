<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Model_Payment extends MY_Model
{

  /**
   * CLASS PROPERTIES
   */
  protected $table            = 'tbl_payments';
  protected $pay_amount       = 'pay_amount';
  protected $pay_date         = 'pay_date';

  protected $relate_user_meta = 'tbl_user_meta';
  protected $relate_user_id   = 'user_id';

  function __construct() {
    parent:: __construct();
  }

  /**
   * GET PAYMENT
   */
  public function get_payments( $id ) {
    if ( ! empty( $id ) ) {
      $this->db->select( '`pay_amount`, `pay_date`, `pay_reciever`, `user_fname`' )->where( '`tbl_payments`.`user_id`', $id );
      $this->db->join( $this->relate_user_meta, '`tbl_payments`.`pay_reciever`=`tbl_user_meta`.`user_id`' );
      $query = $this->db->get( $this->table );

      if( $query ) {
        return $query->result();
      }
    }
  }

}

/* End of file Model_Payment.php */
/* Location: ./application/modules/account/models/Model_Payment.php */
