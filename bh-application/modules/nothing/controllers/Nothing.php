<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Nothing extends MY_Controller 
{

	function __construct() {
		parent::__construct();
	}

	/**
	 * Page not found
	 */
	public function index() {
    $this->template->set_master_template( 'layouts/layout_site' );
    $this->template->write( 'title', 'Page not found' );
    $this->template->write_view( 'content', 'view_nothing' );
    $this->template->render();
	}

}

/* End of file Nothing.php */
/* Location: ./application/modules/nothing/controllers/Nothing.php */
