<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists( 'sesscheck' ) ) {
  /**
   * SESSION CHECKER
   * 
   * Check the rule for the login user.
   * @return boolean
   */
  function sesscheck() {

    // User rule
    $rule = $_SESSION['user_rule'];
    switch ( $rule ) {
      case 'administrator':
        return true;
        break;
      case 'booker':
        return false;
        break;
      default:
        redirect( base_url( 'login' ) );
        break;
    }
  }
}
