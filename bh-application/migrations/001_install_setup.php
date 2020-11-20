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
				"`set_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`set_price` decimal(5,2) DEFAULT 0",
			),

			'rooms' => array(
				"`room_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`room_name` varchar(30) NOT NULL",
				"`room_equiv` tinyint(2) NOT NULL",
				"`room_rate` decimal(9,2) NOT NULL DEFAULT 0",
				"`room_photo` varchar(200) NOT NULL",
				"`room_desc` text NOT NULL",
				"`room_status` char(10) NOT NULL",
				"`room_available` tinyint(2) NOT NULL",
			),

			'bookings' => array(
				"`book_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`book_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP",
				"`book_arrival` date NOT NULL DEFAULT CURRENT_TIMESTAMP",
				"`book_status` varchar(15) NOT NULL",
				"`book_cancel` datetime NOT NULL",
				"`room_id` int(11) NOT NULL",
				"`user_id` int(11) NOT NULL",
			),

			'payments' => array(
				"`pay_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`pay_amount` decimal(9,2) NOT NULL DEFAULT 0",
				"`pay_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP",
				"`pay_reciever` int(11) NOT NULL",
				"`user_id` int(11) NOT NULL",
			),

			'logs' => array(
				"`log_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`log_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP",
				"`log_task` varchar(60) NOT NULL",
				"`user_id` int(11) NOT NULL",
			),

			'user_meta' => array(
				"`user_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`user_fname` varchar(60) NOT NULL",
				"`user_phone` varchar(30) NOT NULL",
				"`user_email` varchar(30) NOT NULL",
				"`user_add` varchar(255) NOT NULL",
				"`user_photo` varchar(100) NOT NULL",
				"`user_status` char(15) NOT NULL",
			),

			'user_login' => array(
				"`login_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`login_name` varchar(20) NOT NULL",
				"`login_pass` char(32) NOT NULL",
				"`login_level` varchar(25) NOT NULL",
				"`user_id` int(11) NOT NULL",
			),

			'auth_attempts' => array(
				"`auth_id` smallint(6) NOT NULL PRIMARY KEY AUTO_INCREMENT",
				"`auth_attempts` tinyint(1) NOT NULL",
				"`auth_date` datetime NOT NULL",
				"`auth_user` varchar(60) NOT NULL",
			),

			'sessions' => array(
				"`id` varchar(128) NOT NULL",
				"`ip_address` varchar(45) NOT NULL",
				"`timestamp` int(10) unsigned DEFAULT 0 NOT NULL",
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