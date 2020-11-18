<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Model_Setup extends MY_Model
{

  function __construct() {
    parent:: __construct();
  }

  /**
   * Generate dummy data
   */
  public function generate_sales() {
    $flag = false;
    
    $s = DateTime::createFromFormat('d-m-Y H:i:s', '08-11-2020 00:00:00');
    $e = DateTime::createFromFormat('d-m-Y H:i:s', '10-11-2020 00:00:00');

    $items_id = $this->db->select( '`id`, `item_id`' )->get( 'tbl_items' )->result();
    foreach ( $items_id as $row ) {
      
      $total = mt_rand( 50, 1000 );
      $or    = mt_rand( 100000, 999999 );
      $int   = mt_rand( $s->getTimestamp(), $e->getTimestamp() );
      $date  = strval( date( 'Y-m-d', $int ) );

      if ( $this->db->simple_query('INSERT INTO `tbl_sales`(`cust_id`, `sales_date`, `sales_total`, `sales_or`, `sales_tellerid`, `sales_discount`) VALUES ("1", "'.$date.'", "'.$total.'", "'.$or.'", "1", "0")') ) {
        $sales_id = $this->db->select('MAX(`sales_id`) AS `id`')->get('tbl_sales')->row()->id;
        if ( $this->db->simple_query('INSERT INTO `tbl_salesinfo`(`sales_id`, `item_id`, `unit_price`, `no_of_items`) VALUES ('.$sales_id.', '.$row->item_id.', 50, 2)') ) {
          $flag = true;
        }
      }
    }
    if ( $flag ) {
      return true;
    }
  }

  /**
   * Cleanup table data
   */
  public function clean_dummy( $table ) {
    $table = strtolower( $table );
    switch ( $table ) {
      case 'unit convert':
        if( $this->db->truncate( 'tbl_unitconvert' ) ) { 
          return true; 
        }
        break;
      case 'unit':
        if( $this->db->truncate( 'tbl_unit' ) ) {
          return true; 
        }
        break;
      case 'sub category':
        if( $this->db->truncate( 'tbl_subcategory' ) ) { 
          return true; 
        }
        break;
      case 'sales info':
        if( $this->db->truncate( 'tbl_salesinfo' ) ) { 
          return true; 
        }
        break;
      case 'sales':
        if( $this->db->truncate( 'tbl_sales' ) ) { 
          return true; 
        }
        break;
      case 'orders':
        if( $this->db->truncate( 'tbl_orders' ) ) { 
          return true; 
        }
        break;
      case 'order inventory':
        if( $this->db->truncate( 'tbl_orderinventory' ) ) { 
          return true; 
        }
        break;
      case 'order details':
        if( $this->db->truncate( 'tbl_orderdetails' ) ) { 
          return true; 
        }
        break;
      case 'items':
        if( $this->db->truncate( 'tbl_items' ) ) { 
          return true; 
        }
        break;
      case 'inventory':
        if( $this->db->truncate( 'tbl_inventory' ) ) { 
          return true; 
        }
        break;
      case 'category':
        if( $this->db->truncate( 'tbl_category' ) ) { 
          return true; 
        }
        break;
      case 'company':
        if( $this->db->truncate( 'tbl_companyinfo' ) ) { 
          return true; 
        }
        break;
      case 'damage items':
        if( $this->db->truncate( 'tbl_damagestocks' ) ) { 
          return true; 
        }
        break;
      case 'order details expiry':
        if( $this->db->truncate( 'tbl_orderdetails_expiry' ) ) { 
          return true; 
        }
        break;
      case 'user':
        if( $this->db->truncate( 'tbl_userinfo' ) ) { 
          if( $this->db->truncate( 'tbl_users' ) ) { 
            if ( $this->db->simple_query( 'INSERT INTO `tbl_users` (`username`, `user_pass`, `user_level`, `user_id`) VALUES ("admin", "21232f297a57a5a743894a0e4a801fc3", "administrator", 1)' ) ) {
              if ( $this->db->simple_query( 'INSERT INTO `tbl_userinfo` (`userinfo_id`, `userinfo_name`, `userinfo_address`, `userinfo_nickname`) VALUES (1, "system admin", "dinagat sslands", "admin")' ) ) {
                return true;
              }
            }
          }
        }
        break;
      case 'log':
        if( $this->db->truncate( 'tbl_log' ) ) { 
          return true; 
        }
        break;
      case 'all':

        $tables =  array ( 
          'tbl_unitconvert',
          'tbl_unit',
          'tbl_subcategory',
          'tbl_salesinfo',
          'tbl_sales',
          'tbl_orders',
          'tbl_orderinventory',
          'tbl_orderdetails',
          'tbl_items',
          'tbl_inventory',
          'tbl_category',
          'tbl_log',
          'tbl_ucjunc',
          'tbl_companyinfo',
          'tbl_userinfo',
          'tbl_users',
          'tbl_damagestocks',
          'tbl_orderdetails_expiry',
        );

        foreach ( $tables as $table ) {
          $this->db->truncate( $table );
        }

        if ( $this->db->simple_query( 'INSERT INTO `tbl_users` (`username`, `user_pass`, `user_level`, `user_id`) VALUES ("admin", "21232f297a57a5a743894a0e4a801fc3", "administrator", 1)' ) ) {
          if ( $this->db->simple_query( 'INSERT INTO `tbl_userinfo` (`userinfo_id`, `userinfo_name`, `userinfo_address`, `userinfo_nickname`) VALUES (1, "system admin", "dinagat sslands", "admin")' ) ) {
            return true;
          }
        }

        break;
      default:
        return false;
        break;
    }
  }

}

/* End of file Model_Setup.php */
/* Location: ./application/modules/setup/models/Model_Setup.php */
