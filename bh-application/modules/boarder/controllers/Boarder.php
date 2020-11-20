<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boarder extends MY_Controller
{

  function __construct() {
    parent:: __construct(); 

    // Load models
    $this->load->model( 'booking/Model_Booking' );
  }

	/**
	 * PENDING BOOKING PAGE
	 */
  public function list() {

    // Check session
    // if ( ! sesscheck() ) {
    //   redirect( base_url( 'login' ) );
    // }

    $data['title']  = 'List of Boarders';
    $data['class']  = 'boarder';
    $data['recent']   = $this->Model_Booking->get_bookings( NULL, 'active' );
    $data['list']   = $this->Model_Booking->get_bookings( NULL, 'list' );

    // Load template parts
    $this->template->set_master_template( 'layouts/layout_admin' );
    $this->template->write( 'title', $data['title'] );
    $this->template->write( 'body_class', $data['class'] );

    $this->template->write_view( 'content', 'templates/template_topbar', $data );
    $this->template->write_view( 'content', 'templates/template_left_side' );
    $this->template->write_view( 'content', 'view_borader_list' );
    $this->template->write_view( 'content', 'templates/template_right_side' );
    $this->template->write_view( 'content', 'templates/template_footer' );
    
    // Modal
    $this->template->write_view( 'content', 'modals/modal_boarder_details' );

    // Add JS 
    $this->template->add_js( 'bh-assets/js/pages/page_list.js' );
		$this->template->render();
  }

}

/* End of file Bookings.php */
/* Location: ./application/modules/booking/controllers/Booking.php */
