<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sess
{

  // Admin and User
  static function admin() {
    if ( ! $_SESSION['user_rule'] == 'administrator' || ! $_SESSION['user_rule'] == 'user' || ! $_SESSION['user_rule'] == 'booker' ) {
      redirect( base_url() . 'login' );
    } else {
      if  ( $_SESSION['user_rule'] == 'booker' ) {
        redirect( base_url() . 'account' );
      }
    }
  }

  // Admin, Booker, and User
  static function booker() {
    if ( ! $_SESSION['user_rule'] == 'administrator' || ! $_SESSION['user_rule'] == 'user' || ! $_SESSION['user_rule'] == 'booker' ) {
      redirect( base_url() . 'login' );
    } 
  }

}
