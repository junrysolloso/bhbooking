<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sess
{

  // Admin and User
  static function admin() {
    if ( isset( $_SESSION['user_rule'] ) ) {
      if ( ! $_SESSION['user_rule'] == 'administrator' || ! $_SESSION['user_rule'] == 'user' || ! $_SESSION['user_rule'] == 'booker' ) {
        redirect( base_url() . 'login' );
      } else {
        if  ( $_SESSION['user_rule'] == 'booker' ) {
          redirect( base_url() . 'account' );
        }
      }
    } else {
      redirect( base_url() . 'login' );
    }
  }

  // Admin, Booker, and User
  static function booker() {
    if ( isset( $_SESSION['user_rule'] ) ) {
      if ( ! $_SESSION['user_rule'] == 'administrator' || ! $_SESSION['user_rule'] == 'user' || ! $_SESSION['user_rule'] == 'booker' ) {
        redirect( base_url() . 'login' );
      }    
    } else {
      redirect( base_url() . 'login' );
    }
  }
  
}