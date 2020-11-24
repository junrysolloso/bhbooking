<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists( 'log_lang' ) ) {
  /**
   * Log Messages
   * @param string $activity
   * @return array $task
   */
  function log_lang( $activity ) {

    $task = array (
      'room' => array(
        'delete'  => 'Deleted Room',
        'update'  => 'Updated Room',
        'add'     => 'Added Room ',
        'view'    => 'Viewed Room',
      ),
      'user' => array(
        'delete'  => 'Deleted User',
        'update'  => 'Updated User',
        'add'     => 'Added User',
        'view'    => 'Viewed User',
      ),
      'booking' => array(
        'delete'  => 'Deleted Booking',
        'update'  => 'Updated Booking',
        'add'     => 'Added Booking',
        'view'    => 'Viewed Booking',
        'confirm' => 'Confirmed Booking',
        'cancel'  => 'Cancelled Booking',
      ),
      'payment' => array(
        'delete'  => 'Deleted Payment',
        'update'  => 'Updated Payment',
        'add'     => 'Added Payment',
        'view'    => 'Viewed Payment',
      ),
      'login' => array(
        'in'      => 'Log In',
        'out'     => 'Log Out',
      ),
      'backup' => array(
        'add'     => 'Backup Database',
      ),
      'default'   => 'Cannot Track Task',
    );

    switch ( $activity ) {
      case 'room':
        return $task['room'];
        break;
      case 'user':
        return $task['user'];
        break;
      case 'booking':
        return $task['booking'];
        break;
      case 'payment':
        return $task['payment'];
        break;
      case 'backup':
        return $task['backup'];
        break;
      case 'login':
        return $task['login'];
        break;
      default:
      return $task['default'];
        break;
    }
  }
}

if( ! function_exists( 'clean_array' ) ) {
  /**
   * Clean array
   * @param array $array - array to be clean
   * @return array $array
   */
  function clean_array( $array ) {
    if( is_array( $array ) ) {
      foreach ( $array as $key => $val ) {
        if ( empty(  $val ) ||  $val == NULL ) {
          unset( $array[ $key ] );
        }
      }
      return $array;
    }
  }
}

