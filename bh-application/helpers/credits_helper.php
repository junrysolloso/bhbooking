<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists( 'credits' ) ) {
  /**
   * Credits to the creators
   */
  function credits( $request ) {
    switch ( $request ) {
      case 'co':
        echo '© Alex Boarding House';
        break;
      case 'cr':
        echo 'Created with ❤ by Dinagat Coders';
        break;
      default:
        return false;
        break;
    }
  }
}
