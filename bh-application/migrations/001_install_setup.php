<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_Setup extends CI_Migration 
{
	/**
	 * UPGRADE DATABASE
	 */
	public function up() {

		// Attributes
		$attributes = array( 'ENGINE' => 'MyISAM', 'DEFAULT CHARSET' => 'utf8' );

		// Table fields
		$tables = array(

			'settings' => array(
				"`set_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`set_price` DECIMAL(5,2) DEFAULT 0",
			),

			'rooms' => array(
				"`room_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`room_name` VARCHAR(30) NOT NULL",
				"`room_equiv` TINYINT(2) NOT NULL",
				"`room_rate` DECIMAL(9,2) NOT NULL DEFAULT 0",
				"`room_photo` VARCHAR(200) NOT NULL",
				"`room_desc` TEXT NOT NULL",
				"`room_status` CHAR(10) NOT NULL",
				"`room_available` TINYINT(2) NOT NULL",
			),

			'bookings' => array(
				"`book_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`book_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP",
				"`book_arrival` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP",
				"`book_status` VARCHAR(15) NOT NULL",
				"`book_cancel` DATETIME NOT NULL",
				"`room_id` INT(11) NOT NULL",
				"`user_id` INT(11) NOT NULL",
			),

			'payments' => array(
				"`pay_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`pay_amount` DECIMAL(9,2) NOT NULL DEFAULT 0",
				"`pay_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP",
				"`pay_reciever` INT(11) NOT NULL",
				"`user_id` INT(11) NOT NULL",
				"`book_id` INT(11) NOT NULL",
			),

			'logs' => array(
				"`log_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`log_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP",
				"`log_task` VARCHAR(60) NOT NULL",
				"`user_id` INT(11) NOT NULL",
			),

			'user_meta' => array(
				"`user_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`user_fname` VARCHAR(60) NOT NULL",
				"`user_phone` VARCHAR(30) NOT NULL",
				"`user_email` VARCHAR(30) NOT NULL",
				"`user_add` VARCHAR(255) NOT NULL",
				"`user_photo` VARCHAR(100) NOT NULL",
				"`user_status` CHAR(15) NOT NULL",
			),

			'user_login' => array(
				"`login_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`login_name` VARCHAR(20) NOT NULL",
				"`login_pass` CHAR(32) NOT NULL",
				"`login_level` VARCHAR(25) NOT NULL",
				"`user_id` INT(11) NOT NULL",
			),

			'auth_attempts' => array(
				"`auth_id` INT(2) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`auth_attempts` TINYINT(2) NOT NULL",
				"`auth_date` DATETIME NOT NULL",
				"`auth_user` VARCHAR(60) NOT NULL",
			),

			'sessions' => array(
				"`id` VARCHAR(128) NOT NULL",
				"`ip_address` VARCHAR(45) NOT NULL",
				"`timestamp` INT(10) unsigned DEFAULT 0 NOT NULL",
				"`data` blob NOT NULL",
				"PRIMARY KEY (id)",
				"KEY `ci_sessions_timestamp` (`timestamp`)",
			),
		);

		// Create tables
		foreach ( $tables as $table => $fields ) {
			$this->dbforge->add_field( $fields );
			$this->dbforge->create_table( $table, TRUE, $attributes );
		}

		// Pre-insert data for default admin user
		$this->db->simple_query( 'INSERT INTO `tbl_user_login` (`login_name`, `login_pass`, `login_level`, `user_id`) VALUES ("admin", "21232f297a57a5a743894a0e4a801fc3", "administrator", 1)' );
		$this->db->simple_query( 'INSERT INTO `tbl_user_meta` (`user_fname`, `user_phone`, `user_email`, `user_add`, `user_photo`, `user_status`) VALUES ("system admin", "+639108973533", "junry.s.solloso@gmail.com", "san jose, dinagat islands", "avatar.jpg", "active")' );
	}

	/**
	 * DOWNGRADE DATABASE
	 */
	public function down() {

		// Tables
		$tables = array('tbl_settings', 'tbl_rooms', 'tbl_bookings', 'tbl_payments', 'tbl_logs', 'tbl_user_meta', 'tbl_user_login', 'tbl_auth_attempts', 'tbl_sessions');

		// Drop table
		foreach ( $tables as $table ) {
			$this->dbforge->drop_table( $table );
		}
  }
  
}

/* End of file 001_install_setup.php */
/* Location: ./application/migrations/001_install_setup.php */