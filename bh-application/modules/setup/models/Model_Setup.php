<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Model_Setup extends MY_Model
{

  function __construct() {
    parent:: __construct();
  }

  /**
   * TRUNCATE TABLES
   */
  public function clean_dummy( $table ) {
    $table = strtolower( $table );
    switch ( $table ) {
  
      case 'authentication':
        if( $this->db->truncate( 'tbl_auth_attempts' ) ) {
          return true; 
        }
        break;
      case 'bookings':
        if( $this->db->truncate( 'tbl_bookings' ) ) { 
          return true; 
        }
        break;
      case 'logs':
        if( $this->db->truncate( 'tbl_logs' ) ) { 
          return true; 
        }
        break;
      case 'payments':
        if( $this->db->truncate( 'tbl_payments' ) ) { 
          return true; 
        }
        break;
      case 'rooms':
        if( $this->db->truncate( 'tbl_rooms' ) ) { 
          return true; 
        }
        break;
      case 'settings':
        if( $this->db->truncate( 'tbl_settings' ) ) { 
          return true; 
        }
        break;      
      case 'user':
        if( $this->db->truncate( 'tbl_user_login' ) ) { 
          if( $this->db->truncate( 'tbl_user_meta' ) ) { 
            if ( $this->db->simple_query( 'INSERT INTO `tbl_user_login` (`login_name`, `login_pass`, `login_level`, `user_id`) VALUES ("admin", "21232f297a57a5a743894a0e4a801fc3", "administrator", 1)' ) ) {
		          if ( $this->db->simple_query( 'INSERT INTO `tbl_user_meta` (`user_fname`, `user_phone`, `user_email`, `user_add`, `user_photo`, `user_status`) VALUES ("system admin", "+639108973533", "junry.s.solloso@gmail.com", "san jose, dinagat islands", "avatar.jpg", "active")' ) ) {
                return true;
              }  
            }
          }
        }
        break;
      case 'all':

        $tables =  array ( 
          'tbl_auth_attempts',
          'tbl_bookings',
          'tbl_logs',
          'tbl_payments',
          'tbl_rooms',
          'tbl_settings',
          'tbl_user_login',
          'tbl_user_meta',
        );

        foreach ( $tables as $table ) {
          $this->db->truncate( $table );
        }

        if ( $this->db->simple_query( 'INSERT INTO `tbl_user_login` (`login_name`, `login_pass`, `login_level`, `user_id`) VALUES ("admin", "21232f297a57a5a743894a0e4a801fc3", "administrator", 1)' ) ) {
          if ( $this->db->simple_query( 'INSERT INTO `tbl_user_meta` (`user_fname`, `user_phone`, `user_email`, `user_add`, `user_photo`, `user_status`) VALUES ("system admin", "+639108973533", "junry.s.solloso@gmail.com", "san jose, dinagat islands", "avatar.jpg", "active")' ) ) {
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
