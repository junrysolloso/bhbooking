<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists( 'credits' ) ) {
  /**
   * CREDIT TO PROGRAMMER(S)
   */
  function credits( $request ) {
    switch ( $request ) {
      case 'co':
        echo '© Alex Boarding House';
        break;
      case 'cr':
        echo 'Created with ❤ by Junry Solloso';
        break;
      default:
        return false;
        break;
    }
  }
}
