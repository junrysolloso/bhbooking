<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends MY_Controller 
{

  function __construct() {
    parent:: __construct(); 

    // if ( $this->session->userdata( 'user_rule' ) != 'administrator' ) {
    //   redirect( base_url( 'login' ) );
    // }
  }

	/**
	 * Index for the backup page
	 */
  public function index() {

    // Load the DB utility
    $this->load->dbutil();
    
    // Name of the backup
    $name_non = 'DB_' . strval( date("Ymd") .'_'. date("his") ) . '.sql';
    $name_com = 'DB_' . strval( date("Ymd") .'_'. date("his") ) . '.zip';

    // Configs
    $config = array(
      'format'      => 'zip',
      'filename'    => $name_non,
      'add_drop'    => TRUE,
      'add_insert'  => TRUE,
      'newline'     => "\n"
    );

    // Backup your entire database
    $backup = $this->dbutil->backup( $config );
    if ( $backup ) {

      $this->Model_Log->add_log( log_lang( 'backup' )['add'] );

      // Load the file helper and write the file 
      $this->load->helper( 'file' );
      write_file( FCPATH . 'bh-backup/'. $name_com, $backup );

      // Load the download helper and send the file to your desktop
      $this->load->helper( 'download' );
      force_download( $name_com, $backup );

    }
  }

}

/* End of file Backup.php */
/* Location: ./application/modules/backup/controllers/Backup.php */
